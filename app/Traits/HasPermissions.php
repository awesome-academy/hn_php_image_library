<?php

namespace App\Traits;

use App\Repositories\Eloquent\PermissionRepository;

trait HasPermissions
{
    public function hasPermission($permission = null)
    {
        if (is_null($permission)) {
            return false;
        }

        return in_array($permission, $this->getPermissions());
    }

    private function getPermissions()
    {
        $rp = PermissionRepository::getPermissionByRole($this->role_id);
        $role_permissions = [];
        if (count($rp) > 0) {
            $i = 0;
            foreach ($rp as $value) {
                $role_permissions[$i] = $value['name'];
                $i++;
            }
        }

        return $role_permissions;
    }
}
