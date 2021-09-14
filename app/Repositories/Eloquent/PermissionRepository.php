<?php

namespace App\Repositories\Eloquent;

use App\Models\Permission;
use App\Repositories\Interfaces\PermissionRepositoryInterface;

class PermissionRepository implements PermissionRepositoryInterface
{
    public function getAll()
    {
        return Permission::all();
    }

    public static function getPermissionByRole($role_id)
    {
        return Permission::whereHas('roles', function ($q) use ($role_id) {
            $q->where('id', $role_id);
        })->get();
    }

    public function getSearch($query)
    {
        return Permission::where('name', 'LIKE', '%' . $query . '%')
            ->orderBy('id', 'DESC')
            ->paginate(config('project.admin_page_count'));
    }
}
