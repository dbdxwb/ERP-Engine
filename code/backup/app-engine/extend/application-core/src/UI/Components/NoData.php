<?php

namespace DevEngine\Core\UI\Components;

use Illuminate\View\Component;

/**
 * 数据不存在
 * Class NoData
 * @package DevEngine\Core\UI\Components
 */
class NoData extends Component
{
    public $title;
    public $content;
    public $reload;

    public function __construct($title = '未找到数据', $content = '暂时未找到数据，您可以尝试刷新页面', $reload = true)
    {
        $this->title = $title;
        $this->content = $content;
        $this->reload = $reload;
    }

    /**
     * @return mixed
     */
    public function render()
    {
        return view('vendor.dev-engine.dev-engine-app.src.core.UI.View.Components.nodata');
    }
}
