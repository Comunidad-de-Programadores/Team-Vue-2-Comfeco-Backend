<?php

namespace App\Repositories\General;

use App\Models\Role;

class RoleRepository
{
    public function findByName($name)
    {
        $role = Role::whereName($name)->first();

        return $role;
    }
}
