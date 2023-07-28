<?php

namespace DevEngine\Core\Model;

/**
 * Class Jobs
 * @package DevEngine\Core\Model
 */
class Jobs extends \DevEngine\Core\Model\Base
{

    protected $table = 'jobs';

    protected $primaryKey = 'id';

    public $timestamps = false;

    protected $casts = [
        'payload' => 'array',
    ];

}
