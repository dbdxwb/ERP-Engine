<?php

use \DevEngine\Core\Facades\Menu;


Menu::push('cms', function () {
    Menu::group([
        'name'  => '内容管理',
        'order' => 0,
    ], function () {
        $model = \Modules\Article\Model\ArticleModel::get();
        $model->map(function ($item) {
            Menu::link($item['name'] . '管理', 'admin.article.article', ['model' => $item['model_id']]);
        });
        Menu::link('模型管理', 'admin.article.articleModel');
        Menu::link('内容属性', 'admin.article.attribute');
    });

    // Menu::group([
    //     'name'  => '内容设置',
    //     'order' => 200,
    // ], function () {
    //
    // });

});
