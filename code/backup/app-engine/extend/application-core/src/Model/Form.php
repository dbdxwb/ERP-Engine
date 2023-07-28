<?php

namespace DevEngine\Core\Model;

/**
 * Class Form
 * @package DevEngine\Core\Model
 */
class Form extends \DevEngine\Core\Model\Base
{

    protected $table = 'form';

    protected $primaryKey = 'form_id';

    protected $casts = [
        'data' => 'array',
    ];

}
