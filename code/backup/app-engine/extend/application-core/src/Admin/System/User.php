<?php

namespace DevEngine\Core\Admin\System;

class User extends Expend
{
    public string $model = \DevEngine\Core\Model\SystemUser::class;

    use \DevEngine\Core\Manage\User;

}
