<?php

namespace App\Http\Controllers;

use App\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;

class RoleController extends Controller
{
    public function index(Request $request)
    {
        $roles = Role::orderBy('id', 'ASC')->get();
        $i = 0;
        return view('body.roles.index', compact('roles', 'i'));
    }

    public function create()
    {
        return view('body.roles.create');
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|unique:roles,name',
            'display_name' => 'required'
        ]);

        Role::create([
            'name' => $request->input('name'),
            'guard_name' => 'web',
            'display_name' => $request->input('display_name'),
            'description' => $request->input('description')
        ]);

        Session::flash('message', 'Role created successfully.');
        return redirect('roles');
    }

    public function show($id)
    {
        return redirect('roles');
    }

    public function edit($id)
    {
        return redirect('roles');
    }

    public function update(Request $request, $id)
    {
        Session::flash('message', 'Role update is not enabled.');
        return redirect('roles');
    }

    public function destroy($id)
    {
        $role = Role::find($id);
        if (!$role) {
            Session::flash('error', 'Role not found.');
            return redirect('roles');
        }

        $assignedUsers = DB::table('model_has_roles')
            ->where('role_id', $id)
            ->count();

        if ($assignedUsers > 0) {
            Session::flash('error', 'Role cannot be deleted because users are assigned to it.');
            return redirect('roles');
        }

        $role->delete();
        Session::flash('message', 'Role deleted successfully.');
        return redirect('roles');
    }
}
