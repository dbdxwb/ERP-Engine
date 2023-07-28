<?php

namespace DevEngine\Core\Model;

use Illuminate\Database\Eloquent\Model as Eloquent;
use \Illuminate\Database\Eloquent\Builder;

/**
 * Class Base
 * @package DevEngine\Core\Model
 */
class Base extends Eloquent
{

    use Expend;

    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);
    }

}
