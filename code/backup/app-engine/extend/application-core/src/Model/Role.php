<?php

namespace DevEngine\Core\Model;

/**
 * Class Role
 * @package DevEngine\Core\Model
 */
class Role extends \DevEngine\Core\Model\Base
{

    protected $table = 'role';

    protected $primaryKey = 'role_id';

    protected $casts = [
        'purview' => 'array',
    ];

    protected $fillable = [];
    protected $guarded = [];

    public static function create(array $attributes = [])
    {
        $attributes['guard'] = $attributes['guard'] ?? 'core';
        return static::query()->create($attributes);
    }
}
