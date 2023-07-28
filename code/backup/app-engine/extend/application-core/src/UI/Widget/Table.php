<?php

namespace DevEngine\Core\UI\Widget;

use DevEngine\Core\UI\Tools;

/**
 * Class Table
 * @package DevEngine\Core\UI\Widget
 */
class Table extends Widget
{

    private \DevEngine\Core\UI\Table $table;

    /**
     * @param               $data
     * @param callable|null $callback
     */
    public function __construct($data, callable $callback = NULL)
    {
        $this->callback = $callback;
        $this->table = new \DevEngine\Core\UI\Table($data);
    }

    /**
     * @return string
     */
    public function render(): string
    {
        return $this->table->render();
    }

    /**
     * @param $method
     * @param $arguments
     * @return mixed
     */
    public function __call($method, $arguments)
    {
        return $this->table->$method(...$arguments);
    }

}
