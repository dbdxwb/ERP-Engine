<?php

namespace DevEngine\Core\Model;

/**
 * Class Role
 * @package DevEngine\Core\Model
 */
class RoleHas extends \DevEngine\Core\Model\Base
{

    protected $table = 'role_has';

    protected $primaryKey = 'role_id';

    public $timestamps = false;
}
