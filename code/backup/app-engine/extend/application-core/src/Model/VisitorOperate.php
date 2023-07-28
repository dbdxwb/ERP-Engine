<?php

namespace DevEngine\Core\Model;

use Ramsey\Uuid\Uuid;

/**
 * Class VisitorOperate
 * @package DevEngine\Core\Model
 */
class VisitorOperate extends \DevEngine\Core\Model\Base
{

    protected $table = 'visitor_operate';

    protected $primaryKey = 'uuid';

    protected $guarded = [];

    protected static function boot()
    {
        parent::boot();
        static::creating(function($model) {
            $model->{$model->getKeyName()} = Uuid::uuid4()->toString();
        });
    }

    protected $casts = [
        'uuid' => 'string',
        'params' => 'array',
    ];

}
