<?php

namespace DevEngine\Core\UI\Components;

use Illuminate\View\Component;

/**
 * 趋势图标
 * Class Trend
 * @package DevEngine\Core\UI\Components
 */
class Trend extends Component
{
    public $type;

    /**
     * @param $type
     */
    public function __construct($type)
    {
        $this->type = $type;
    }

    /**
     * @return mixed
     */
    public function render()
    {
        return view('vendor.dev-engine.dev-engine-app.src.core.UI.View.Components.trend');
    }
}
