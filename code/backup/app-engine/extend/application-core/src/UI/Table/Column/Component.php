<?php

namespace DevEngine\Core\UI\Table\Column;

/**
 * 组件接口
 * Class Component
 * @package DevEngine\Core\UI
 */
interface Component
{
    public function render($label): array;
}
