<?php

namespace DevEngine\Core\Model;

/**
 * Class FormData
 * @package DevEngine\Core\Model
 */
class FormData extends \DevEngine\Core\Model\Base
{

    protected $table = 'form_data';

    protected $primaryKey = 'data_id';

    protected $casts = [
        'data' => 'array',
    ];

}
