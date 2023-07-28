<?php

namespace DevEngine\Core\Traits;

use DevEngine\Core\Model\Role;

/**
 * Class RoleHas
 * @package DevEngine\Core\Traits
 */
trait RoleHas
{

    /**
     * @return mixed
     */
    public function roles()
    {
        return $this->morphToMany(Role::class, 'role', 'role_has', 'user_id', 'role_id');
    }

}
