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
        $navbar = app(\DevEngine\Core\Util\Menu::class)->getNavbar();
        $list = app(\DevEngine\Core\Util\Menu::class)->getManage('core');
        $static = app(\DevEngine\Core\Util\Menu::class)->getStatic('core');
        $list = array_values($list);
        $apps = app(\DevEngine\Core\Util\Menu::class)->getApps();

        foreach ($list as $value) {
            foreach ($navbar as $key => $item) {
                if ($key == $value['navbar']) {
                    $navbar[$key] = array_merge($item, $value);
                }
            }
        }
        return app_success('ok', [
            'navbar' => $navbar,
            'list'   => $list,
            'apps'   => $apps,
            'static' => $static
        ]);
    }
}
