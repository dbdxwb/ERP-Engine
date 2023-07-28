<?php

namespace DevEngine\Core\Admin\System;

use DevEngine\Core\Model\FileDir;
use DevEngine\Core\UI\Node;
use DevEngine\Core\UI\Widget\Link;
use DevEngine\Core\UI\Widget\TreeList;
use Illuminate\Support\Facades\DB;
use DevEngine\Core\UI\Table;
use DevEngine\Core\UI\Widget;

class FilesDir extends Expend
{
    public string $model = FileDir::class;

    protected function table(): Table
    {
        $table = new Table(new $this->model());
        $table->title('目录管理');
        $table->map([
            'key' => 'dir_id',
            'title' => 'name',
            'has_type',
        ]);
        // Generate Table Make
        return $table;
    }


}
