<?php

namespace DevEngine\Core\UI\Table\Column;


/**
 * Class Progress
 */
class Progress implements Component
{

    private string $color;

    /**
     * @param string $color
     */
    public function __construct(string $color = 'default')
    {
        $this->color = $color;
    }

    /**
     * @param $label
     * @return array
     */
    public function render($label): array
    {
        return (new \DevEngine\Core\UI\Widget\Progress("rowData.record['$label']"))->color($this->color)->render();
    }

}
