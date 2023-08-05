<?php

namespace Modules\Article\Model;

/**
 * Class ArticleModel
 * @package Modules\Article\Model
 */
class ArticleModel extends \DevEngine\Core\Model\Base
{

    protected $table = 'article_model';

    protected $primaryKey = 'model_id';

    public $timestamps = false;

}
