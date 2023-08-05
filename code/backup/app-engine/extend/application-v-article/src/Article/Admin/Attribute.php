<?php

namespace Modules\Article\Admin;

use DevEngine\Core\UI\Form;
use DevEngine\Core\UI\Table;

class Attribute extends \DevEngine\Core\Admin\System\Expend
{

    public string $model = \Modules\Article\Model\ArticleAttribute::class;

    /**
     * @throws \Exception
     */
    protected function table(): Table
    {
        $table = new Table(new $this->model());
        $table->title('内容属性');
        $table->filter('名称', 'name')->text();
        $table->action()->button('添加', 'admin.article.attribute.page')->type('dialog');
        $table->column('#', 'attr_id');
        $table->column('名称', 'name');
        $column = $table->column('操作')->width(150);
        $column->link('编辑', 'admin.article.attribute.page', ['id' => 'attr_id'])->type('dialog');
        $column->link('删除', 'admin.article.attribute.del', ['id' => 'attr_id'])->type('ajax', ['method' => 'post']);
        return $table;
    }

    public function form(int $id = 0): Form
    {
        $form = new Form(new $this->model());
        $form->dialog(true);
        $form->text('属性名称', 'name')->verify([
            'required',
        ], [
            'required' => '请填写属性名称',
        ]);
        return $form;
    }

}
