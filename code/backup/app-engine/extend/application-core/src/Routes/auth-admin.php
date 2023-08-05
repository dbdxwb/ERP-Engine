<?php

use Illuminate\Support\Facades\Route;

Route::group([
    'prefix'   => 'admin',
    'auth_has' => 'core'
], function () {
    Route::group([
        'prefix'    => 'tools',
        'auth_app'  => '扩展工具',
        'namespace' => 'Tools',
    ], function () {
        Route::group([
            'auth_group' => '地区数据'
        ], function () {
            Route::manage(DevEngine\Core\Admin\Tools\Area::class)->only(['index'])->make();
            Route::get('area/add', ['uses' => 'Area@import', 'desc' => '导入'])->name('admin.tools.area.import');
            Route::post('area/store', [
                'uses' => 'Area@importData',
                'desc' => '导入数据'
            ])->name('admin.tools.area.importData');
            Route::post('area/del/{id?}', ['uses' => 'Area@del', 'desc' => '删除'])->name('admin.tools.area.del');
        });

        Route::group([
            'auth_group' => '自定义表单'
        ], function () {
            Route::manage(DevEngine\Core\Admin\Tools\Form::class)->only([
                'index',
                'data',
                'page',
                'save',
                'del'
            ])->make();
            Route::get('form/setting/{id}', [
                'uses' => 'Form@setting',
                'desc' => '设置'
            ])->name('admin.tools.form.setting');
            Route::post('form/setting/{id}', [
                'uses' => 'Form@settingSave',
                'desc' => '设置数据'
            ])->name('admin.tools.form.setting.save');
        });

        Route::group([
            'auth_group' => '表单数据'
        ], function () {
            Route::manage(DevEngine\Core\Admin\Tools\FormData::class)->only([
                'index',
                'data',
                'page',
                'save',
                'status',
                'del'
            ])->make();
        });

        Route::group([
            'auth_group' => '链接管理'
        ], function () {
            Route::manage(DevEngine\Core\Admin\Tools\Url::class)->only(['data'])->make();
        });

        // Generate Route Make
    });


    // 系统资源
    Route::group([
        'public'    => true,
        'namespace' => 'System'
    ], function () {
        /**
         * 公共资源
         */
        Route::get('menu', ['uses' => 'Index@menu', 'desc' => '系统菜单'])->name('admin.menu');
        Route::get('side/{app}', ['uses' => 'Index@side', 'desc' => '系统边栏'])->name('admin.side');
        Route::get('development', ['uses' => 'Development@index', 'desc' => '运维概况'])->name('admin.development');
        Route::get('fileManage', ['uses' => 'FileManage@handle', 'desc' => '文件管理器'])->name('admin.filemanage');
        Route::post('upload', ['uses' => 'Upload@ajax', 'desc' => '文件上传'])->name('admin.upload');
        Route::post('uploadRemote', ['uses' => 'Upload@remote', 'desc' => '远程保存'])->name('admin.uploadRemote');
        Route::get('map/ip', ['uses' => 'Map@weather', 'desc' => 'ip解析'])->name('admin.map.ip');

        /**
         * 消息通知
         */
        Route::get('notification', [
            'uses'               => 'Index@getNotify',
            'desc'               => '获取通知',
            'ignore_operate_log' => true
        ])->name('admin.notification');
        Route::get('notification/read', [
            'uses' => 'Index@readNotify',
            'desc' => '读取消息'
        ])->name('admin.notification.read');
        Route::get('notification/del', ['uses' => 'Index@delNotify', 'desc' => '删除消息'])->name('admin.notification.del');

        /**
         * 系统统计
         */
        Route::get('system/visitorApi/loadTotal', [
            'uses' => 'VisitorApi@loadTotal',
            'desc' => '访问统计'
        ])->name('admin.system.visitorApi.loadTotal');
        Route::get('system/visitorApi/loadDelay', [
            'uses' => 'VisitorApi@loadDelay',
            'desc' => '延迟统计'
        ])->name('admin.system.visitorApi.loadDelay');
        Route::get('system/visitorOperate/loadData', [
            'uses' => 'VisitorOperate@loadData',
            'desc' => '操作日志'
        ])->name('admin.system.visitorOperate.loadData');
        Route::get('system/visitorViews/info', [
            'uses' => 'VisitorViews@info',
            'desc' => '访客详情'
        ])->name('admin.system.visitorViews.info');

    });

    /**
     * 系统应用
     */
    Route::group([
        'prefix'    => 'system',
        'auth_app'  => '系统应用',
        'namespace' => 'System'
    ], function () {
        /**
         * 系统设置
         */
        Route::group([
            'auth_group' => '系统设置'
        ], function () {
            Route::get('setting', ['uses' => 'Setting@handle', 'desc' => '系统设置'])->name('admin.system.setting');
            Route::post('setting/store', [
                'uses' => 'Setting@save',
                'desc' => '保存设置'
            ])->name('admin.system.setting.save');
        });
        /**
         * 系统用户
         */
        Route::group([
            'auth_group' => '系统用户'
        ], function () {
            Route::manage(DevEngine\Core\Admin\System\User::class)->only([
                'index',
                'data',
                'page',
                'save',
                'del'
            ])->make();
        });
        /**
         * 系统角色
         */
        Route::group([
            'auth_group' => '系统角色'
        ], function () {
            Route::manage(DevEngine\Core\Admin\System\Role::class)->only([
                'index',
                'data',
                'page',
                'save',
                'del'
            ])->make();
        });
        /**
         * 操作日志
         */
        Route::group([
            'auth_group' => '操作日志'
        ], function () {
            Route::get('operate', ['uses' => 'VisitorOperate@index', 'desc' => '列表'])->name('admin.system.operate');
            Route::get('operate/ajax', [
                'uses' => 'VisitorOperate@ajax',
                'desc' => '列表'
            ])->name('admin.system.operate.ajax');
            Route::get('operate/info/{id}', [
                'uses' => 'VisitorOperate@info',
                'desc' => '详情'
            ])->name('admin.system.operate.info');
        });

        Route::group([
            'auth_group' => '文件管理'
        ], function () {
            Route::manage(DevEngine\Core\Admin\System\FilesDir::class)->only(['index'])->make();
            Route::manage(DevEngine\Core\Admin\System\Files::class)->only(['index', 'del'])->make();
        });

        Route::group([
            'auth_group' => '接口统计'
        ], function () {
            Route::manage(DevEngine\Core\Admin\System\VisitorApi::class)->only(['index'])->make();
        });

        /**
         * 系统队列
         */
        Route::group([
            'auth_group' => '任务调度'
        ], function () {
            Route::manage(DevEngine\Core\Admin\System\Task::class)->only(['index'])->make();
        });


        Route::group([
            'auth_group' => '应用中心'
        ], function () {
            Route::get('application', [
                'uses' => 'Application@index',
                'desc' => '列表'
            ])->name('admin.system.application');
        });

        /**
         * 接口授权
         */
        Route::group([
            'auth_group' => '接口授权'
        ], function () {
            Route::manage(DevEngine\Core\Admin\System\Api::class)->only([
                'index',
                'data',
                'page',
                'save',
                'del'
            ])->make();
            Route::post('api/token/{id?}', [
                'uses' => 'Api@token',
                'desc' => '更换TOKEN'
            ])->name('admin.system.api.token');
        });
    });

});

