<?php

use \DevEngine\Core\Facades\Menu;

Menu::add('cms', [
    'name'  => 'CMS',
    'icon'  => '<svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 8h14M5 8a2 2 0 110-4h14a2 2 0 110 4M5 8v10a2 2 0 002 2h10a2 2 0 002-2V8m-9 4h4" /></svg>',
    'order' => 11,
], function () {
    Menu::group([
        'name'  => '站点工具',
        'order' => 0,
    ], function () {
        Menu::link('菜单管理', 'admin.cms.menu');
        Menu::link('自定义页面', 'admin.cms.page');
        Menu::link('内容标签', 'admin.cms.tags');
        Menu::link('模板标记', 'admin.cms.mark');
    });

    Menu::group([
        'name'  => '站点菜单',
        'order' => 1,
    ], function () {
        $model = \Modules\Cms\Model\CmsMenu::get();
        $model->map(function ($item) {
            Menu::link($item['name'], 'admin.cms.menuItems', ['menu' => $item['menu_id']]);
        });
    });
});
