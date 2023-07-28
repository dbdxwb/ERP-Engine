<?php

namespace DevEngine\Core\UI\Widget;

/**
 * Class Form
 * @package DevEngine\Core\UI\Widget
 */
class Form extends Widget
{

    private \DevEngine\Core\UI\Form $form;

    public function __construct($data, callable $callback = null)
    {
        $this->callback = $callback;
        $this->form = new \DevEngine\Core\UI\Form($data, false);
    }

    /**
     * @return string
     */
    public function render(): string
    {
        return $this->form->render();
    }

    /**
     * @param $method
     * @param $arguments
     * @return mixed
     */
    public function __call($method, $arguments)
    {
        return $this->form->$method(...$arguments);
    }

}
