<?php

namespace DevEngine\Core\Model;

/**
 * Class JobsFailed
 * @package DevEngine\Core\Model
 */
class JobsFailed extends \DevEngine\Core\Model\Base
{

    protected $table = 'jobs_failed';

    protected $primaryKey = 'id';

    public $timestamps = false;

    protected $casts = [
        'payload' => 'array',
    ];

}
