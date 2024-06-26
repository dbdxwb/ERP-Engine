<?php

namespace DevEngine\Core\UI\Table;

use DevEngine\Core\UI\Form\Date;
use DevEngine\Core\UI\Form\Daterange;
use DevEngine\Core\UI\Form\Datetime;
use DevEngine\Core\UI\Form\Select;
use DevEngine\Core\UI\Form\Text;
use DevEngine\Core\UI\Table;
use DevEngine\Core\UI\Widget\Icon;

/**
 * 类型筛选
 * Class Column
 * @package DevEngine\Core\UI\Filter
 */
class FilterType
{

    protected string $name;
    protected ?\Closure $callback;
    protected ?\Closure $where;
    protected string $icon = '';
    protected ?int $num = null;
    protected ?Table $layout;
    protected $model;
    protected $value;

    /**
     * @param string        $name
     * @param callable|null $where
     * @param int           $value
     */
    public function __construct(string $name, callable $where = null, int $value = 0)
    {
        $this->name = $name;
        $this->where = $where;
        $this->value = $value;
    }

    public function setLayout(Table $layout): void
    {
        $this->layout = $layout;
        $this->model = $layout->model();
    }

    public function num($num = 0): self
    {
        $this->num = $num;
        return $this;
    }

    public function icon($content): self
    {
        $this->icon = $content;
        return $this;
    }

    public function execute($query, $key): void
    {
        if ($this->where instanceof \Closure && $this->value == $key) {
            call_user_func($this->where, $this->model);
        }
    }

    /**
     * @param $key
     * @return array
     */
    public function render($key): array
    {
        return [
            'nodeName' => 'a-radio',
            'value' => $key,
            'child' => [
                $this->icon ? [
                    'nodeName' => $this->icon
                ]: [],
                [
                    'nodeName' => 'span',
                    'child' => ' ' . $this->name
                ]
            ]
        ];

    }
}
