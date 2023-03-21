<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Role\UpdateRequest;
use App\Models\Permission;
use App\Models\Role;
use Illuminate\Http\Request;

class RoleController extends Controller
{
    public function index() {
        $roles = Role::orderBy('name')->paginate(10);
        $permissions = Permission::all();
        return view('admin.role.index', compact('roles', 'permissions'));
    }
    public function update(UpdateRequest $req, Role $role) {
        $permissions = $req->permissions;
        $role->permissions()->sync($permissions);
        return response()->json([
            'perms' => $role->permissions,
            'role_id' => $role->id,
        ]);
    }
    public function store() {

    }
    public function destroy() {
        
    }
}
