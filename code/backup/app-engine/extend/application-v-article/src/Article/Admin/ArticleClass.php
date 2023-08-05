<?php

namespace Modules\Article\Admin;

use DevEngine\Core\Util\Tree;
use DevEngine\Core\UI\Form;
use DevEngine\Core\UI\Table;
use Modules\Tools\UI\UrlSelect;

class ArticleClass extends ArticleExpend
{

    use \DevEngine\Core\Traits\TableSortable;

    public string $model = \Modules\Article\Model\ArticleClass::class;

    protected function table(): Table
    {
        $table = new Table(new $this->model());
        $table->title('分类管理');
        $table->model()->scoped(['model_id' => $this->modelId])->defaultOrder();
        $table->tree();
        $table->map([
            'key' => 'tree_id',
            'title' => 'name',
        ]);
        return $table;
    }

    public function form(?int $id = 0): Form
    {
        $classId = request()->get('class_id');
        $form = new Form(new $this->model());
        $form->dialog(true);
        $form->action(route('admin.article.articleClass.save', ['model' => $this->modelId, 'id' => $id]));

        $form->cascader('上级分类', 'parent_id', function ($value) {
            return $this->model::scoped(['model_id' => $this->modelId])->defaultOrder()->get(['class_id as id', 'parent_id as pid', 'name']);
        })->leaf(false)->default($classId);

        $form->text('分类名称', 'name')->verify([
            'required',
        ], [
            'required' => '请填写分类名称',
        ]);
        $form->text('分类副名称', 'subname');
        $form->image('封面图', 'image');
        $form->textarea('分类简介', 'content');
        $form->text('分类关键词', 'keyword');
        $form->text('分类描述', 'description');

        $form->extend('urlSelect', UrlSelect::class);
        $form->urlSelect('跳转链接', 'url', route('admin.tools.url.data'));

        $form->text('分类模板', 'tpl_class')->afterText('.blade.php');
        $form->text('内容模板', 'tpl_content')->afterText('.blade.php');

        $form->front(function ($data, $type, $model) {
            $model->model_id = $this->modelId;
            return $model;
        });
        return $form;
    }

}
