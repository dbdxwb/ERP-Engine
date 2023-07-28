<?php

namespace DevEngine\Core\Admin\System;

use DevEngine\Core\Util\View;

class Index extends Common
{

    use \DevEngine\Core\Manage\Notify;

    public function index()
    {
        return View::manage();
    }

    public function menu()
    {
        $list = app(\DevEngine\Core\Util\Menu::class)->getManage('admin');
        $static = app(\DevEngine\Core\Util\Menu::class)->getStatic('admin');
        $list = array_values($list);
        $apps = app(\DevEngine\Core\Util\Menu::class)->getApps();
        return app_success('ok', [
            'list' => $list,
            'apps' => $apps,
            'static' => $static
        ]);
    }
}
