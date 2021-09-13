<?php

namespace App\Repositories\Interfaces;

interface PermissionRepositoryInterface
{
    public function getAll();

    public function getSearch($query);

    public static function getPermissionByRole($role_id);
}
