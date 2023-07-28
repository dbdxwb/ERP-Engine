<?php

namespace DevEngine\Core\Web;

use DevEngine\Core\Controllers\Controller;

class Area extends Controller
{

    public function index()
    {
        $level = request()->get('level', 4);
        $options = \DevEngine\Core\Model\Area::where('level', '<=', $level)->get(['name as label', 'code as value', 'code as id', 'parent_code as pid'])->toArray();
        $options = \DevEngine\Core\Util\Tree::arr2tree($options, 'id', 'pid', 'children');

        return app_success('ok', $options);
    }
}
