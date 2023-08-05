<?php

namespace Modules\Article\Resource;

use DevEngine\Core\Resource\BaseCollection;

class ClassCollection extends BaseCollection
{


    public function toArray($request)
    {
        return $this->collection;
    }

}
