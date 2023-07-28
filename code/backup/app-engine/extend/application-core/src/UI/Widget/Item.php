<?php

namespace DevEngine\Core\UI\Widget;

use DevEngine\Core\UI\Tools;

/**
 * 项目回调
 * @package DevEngine\Core\UI\Widget
 */
class Item
{
    public $params;

    public function __construct($params = [])
    {
        $this->params = $params;
    }

    public function __call($method, $arguments)
    {
        $this->{$method}[] = $arguments;
        return $this;
    }

}
