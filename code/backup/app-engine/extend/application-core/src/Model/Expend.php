<?php

namespace DevEngine\Core\Model;

use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use DevEngine\Core\Util\Tree;
use DevEngine\Core\Service\Form;

/**
 * Trait Expend
 * @package DevEngine\Core\Model
 */
trait Expend
{
    /**
     * 模型关联标志
     * @var string
     */
    protected string $hasName = '';


}
