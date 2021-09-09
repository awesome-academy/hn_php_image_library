<?php

namespace App\Repositories\Interfaces;

interface RoleRepositoryInterface
{
    public function getAllRole();

    public function getSearch($query);

    public function create($request);

    public function update($role, $request);
}
