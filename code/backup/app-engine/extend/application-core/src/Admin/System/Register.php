<?php

namespace DevEngine\Core\Admin\System;

use DevEngine\Core\Model\SystemUser;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

/**
 * 注册用户
 * @package DevEngine\Core\System
 */
class Register extends Common
{

    use \DevEngine\Core\Manage\Register;


    public function submit(Request $request)
    {
        $app = 'System';
        $layer = 'Core';
        Validator::make($request->input(), [
            'username' => ['required', 'string', 'max:255', 'unique:' . strtolower($app) . '_user'],
            'password' => ['required', 'string', 'min:4', 'max:20'],
        ], [
            'username.required' => '用户名输入错误',
            'username.unique'   => '用户名不能重复',
            'password.required' => '请输入4~20位密码',
        ])->validate();


        $user = new SystemUser();

        $role = \DevEngine\Core\Model\Role::firstOrCreate([
            'guard' => strtolower($layer),
        ], [
            'name'    => '管理员',
            'purview' => []
        ]);

        $user->username = $request->input('username');
        $user->password = $request->input('password');
        $user->user_id = 1;
        $user->roles()->attach($role->role_id, ['guard' => $layer]);
        $user->save();

        return app_success('创建账号成功', [
            'userInfo' => [
                'user_id'     => $user->user_id,
                'avatar'      => $user->avatar,
                'avatar_text' => strtoupper(substr($user->username, 0, 1)),
                'username'    => $user->username,
                'nickname'    => $user->nickname,
                'rolename'    => $user->roles[0]['name'],
            ],
            'token'    => 'Bearer ' . auth($layer)->tokenById($user->user_id),
        ]);
    }
}
