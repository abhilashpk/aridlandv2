<?php
namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Role;
use App\Models\User;
use Spatie\Permission\Models\Permission;
use DB;


class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $departmentId = auth()->user()->department_id;

        $roles = Role::orderBy('id','DESC')->paginate(50);
        $roleIds = $roles->pluck('id')->all();
        $assignedCounts = [];
        if (!empty($roleIds)) {
            $assignedCounts = DB::table('model_has_roles')
                ->select('role_id', DB::raw('COUNT(*) AS total'))
                ->whereIn('role_id', $roleIds)
                ->whereIn('model_type', [User::class, 'App\\User'])
                ->where('department_id', $departmentId) // ✅ department filter
                ->groupBy('role_id')
                ->pluck('total', 'role_id')
                ->toArray();
        }

        foreach ($roles as $role) {
            $role->assigned_users_count = (int)($assignedCounts[$role->id] ?? 0);
        }

        return view('body.roles.index',compact('roles'))
            ->with('i', ($request->input('page', 1) - 1) * 5);
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $permission = Permission::orderBy('display_name')->get();
        return view('body.roles.create', compact('permission'));
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $departmentId = auth()->user()->department_id;

        $this->validate($request, [
            'name' => 'required|unique:roles,name',
            'display_name' => 'required',
            'description' => 'nullable',
            'permission' => 'nullable|array',
        ]);


        $role = new Role();
        $role->name = $request->input('name');
        $role->guard_name = 'web';
        $role->display_name = $request->input('display_name');
        $role->description = $request->input('description');
        $role->department_id = $departmentId;
        $role->save();


        $permissionIds = $request->input('permission', []);
        if (!empty($permissionIds)) {
            $role->syncPermissions($permissionIds);
        }


        return redirect()->route('roles.index')
                        ->with('message','Role created successfully');
    }
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $role = Role::find($id);
        $rolePermissions = Permission::join("role_has_permissions","role_has_permissions.permission_id","=","permissions.id")
            ->where("role_has_permissions.role_id",$id)
            ->get();


        return view('roles.show',compact('role','rolePermissions'));
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $role = Role::find($id);
        $permission = Permission::get();
        $rolePermissions = DB::table("role_has_permissions")->where("role_has_permissions.role_id",$id)
            ->lists('role_has_permissions.permission_id','role_has_permissions.permission_id');

 


        return view('roles.edit',compact('role','permission','rolePermissions'));
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'display_name' => 'required',
            'description' => 'required',
            'permission' => 'required',
        ]);


        $role = Role::find($id);
        $role->display_name = $request->input('display_name');
        $role->description = $request->input('description');
        $role->save();


        DB::table("permission_role")->where("permission_role.role_id",$id)
            ->delete();


        foreach ($request->input('permission') as $key => $value) {
            $role->attachPermission($value);
        }


        return redirect()->route('roles.index')
                        ->with('success','Role updated successfully');
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $departmentId = auth()->user()->department_id;

        $role = Role::findOrFail($id);
        $assignedUsers = DB::table('model_has_roles')
            ->where('role_id', $role->id)
            ->whereIn('model_type', [User::class, 'App\\User'])
            ->where('department_id', $departmentId)
            ->count();

        if ($assignedUsers > 0) {
            return redirect()->route('roles.index')
                            ->with('error', 'Cannot delete role. It is assigned to users.');
        }

        $role->delete();
        return redirect()->route('roles.index')
                        ->with('message','Role deleted successfully');
    }
}
