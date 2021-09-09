<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Role;
use App\Repositories\Interfaces\PermissionRepositoryInterface;
use App\Repositories\Interfaces\RoleRepositoryInterface;
use Illuminate\Http\Request;

class RoleController extends Controller
{
    protected $repository;

    public function __construct(RoleRepositoryInterface $repository)
    {
        $this->repository = $repository;
    }

    public function index(Request $request)
    {
        $roles = $this->repository->getSearch($request['search']);

        return view('admin.roles.role_index', ['roles' => $roles]);
    }

    public function create(PermissionRepositoryInterface $permissionRepository)
    {
        $permissions = $permissionRepository->getAll();

        return view('admin.roles.role_create', [
            'permissions' => $permissions,
        ]);
    }

    public function store(Request $request)
    {
        $this->repository->create($request);

        return redirect()->route('roles.index')
            ->with('success', __('create_success', ['name' => __('role')]));
    }

    public function edit(PermissionRepositoryInterface $permissionRepository, Role $role)
    {
        $permissions = $permissionRepository->getAll();
        $rp = $permissionRepository->getPermissionByRole($role['id']);
        $role_permissions = array();
        if (count($rp) > 0) {
            $i = 0;
            foreach ($rp as $value) {
                $role_permissions[$i] = $value['id'];
                $i++;
            }
        }

        return view('admin.roles.role_create', [
            'role' => $role,
            'permissions' => $permissions,
            'role_permissions' => $role_permissions,
        ]);
    }

    public function update(Request $request, Role $role)
    {
        $this->repository->update($role, $request);

        return redirect()->route('roles.index')
            ->with('success', __('update_success', ['name' => __('role')]));
    }

    public function destroy(Role $role)
    {
        $role->delete();

        return redirect()->route('roles.index')
            ->with('success', __('delete_success', ['name' => __('role')]));
    }
}
