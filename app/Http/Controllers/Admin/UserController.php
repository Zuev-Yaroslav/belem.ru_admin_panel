<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Filters\UserFilter;
use App\Http\Requests\User\FilterRequest;
use App\Models\Permission;
use App\Models\Role;
use App\Models\RolePermission;
use App\Models\User;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
    public function index(FilterRequest $req)
    // : Factory|View|Application
    {
        $data = $req->validated();
        if (!isset($data['userNameSort']) && (!isset($data['roleSort']) && !isset($data['emailSort']))) {
            $data['userNameSort'] = 'asc';
        }
        $filter = app()->make(UserFilter::class, ['queryParams' => array_filter($data)]);
        $users = User::select(['users.*'])
            ->join('roles', 'users.role_id', '=', 'roles.id')->filter($filter)->paginate(10);
        $roles = Role::orderBy('name')->get();
        $_GET['111'] = 111;
        $permissions = Permission::orderBy('permission_name')->get();

        if ($req->ajax()) {
            $list = view('includes.admin.user.list', compact('users'))->render();

            $pagination = view('includes.admin.user.pagination', compact('users'))->render();

            return response()->json([
                'list' => $list,
                'pagination' => $pagination,
                'get_roles' => $role_id = (isset($data['role_id'])) ? $data['role_id'] : null, 
                'get_perms' => $permission_id = (isset($data['permission_id'])) ? $data['permission_id'] : null,
            ]);
        }

        return view('admin.user.index', compact('users', 'roles', 'permissions'));
    }
}
