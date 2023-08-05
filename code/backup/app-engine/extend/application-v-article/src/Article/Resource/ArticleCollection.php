<?php

namespace Modules\Article\Resource;

use DevEngine\Core\Resource\BaseCollection;

class ArticleCollection extends BaseCollection
{

    public function toArray($request)
    {
        return $this->collection;
    }

}
