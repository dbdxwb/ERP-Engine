<?php

namespace DevEngine\Core\Model;

use Illuminate\Database\Eloquent\Model as Eloquent;

/**
 * Class ModelAgent
 * @package DevEngine\Core\Model
 */
class ModelAgent
{
    /**
     * @var Eloquent
     */
    public $model;

    public function __construct(Eloquent $model)
    {
        $this->model = $model;
    }

    public function eloquent()
    {
        return $this->model;
    }

    /**
     * @param $method
     * @param $arguments
     * @return ModelAgent
     */
    public function __call($method, $arguments)
    {
        $this->model = $this->model->$method(...$arguments);
        return $this;
    }
}
