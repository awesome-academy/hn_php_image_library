<?php

namespace App\Repositories\Eloquent;

use App\Models\Role;
use App\Repositories\Interfaces\RoleRepositoryInterface;

class RoleRepository implements RoleRepositoryInterface
{
    public function getAllRole()
    {
        return Role::all();
    }

    public function getSearch($query)
    {
        return Role::where('name', 'LIKE', '%' . $query . '%')
            ->orderBy('id', 'DESC')
            ->paginate(config('project.admin_page_count'));
    }

    public function create($request)
    {
        $role = Role::create($request->all());

        return $role->permissions()->attach($request['permission_id']);
    }

    public function update($role, $request)
    {
        $role->update($request->all());
        $role->permissions()->detach();

        return $role->permissions()->attach($request['permission_id']);
    }
}
