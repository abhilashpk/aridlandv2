<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;
use App\Models\Department;

class User extends Authenticatable
{
    use HasApiTokens, Notifiable, HasRoles;

    protected $table = 'users';   // your real auth table
    protected $primaryKey = 'id';

    protected $fillable = [
        'name','email','password','department_id','location_id','role_id'
    ];

    protected $hidden = [
        'password','remember_token'
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function role()
    {
        return $this->belongsTo(Role::class, 'role_id');
    }

    public function department()
    {
        return $this->belongsTo(Department::class, 'department_id');
    }
}
