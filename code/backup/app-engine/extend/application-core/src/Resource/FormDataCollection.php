<?php

namespace DevEngine\Core\Resource;

use DevEngine\Core\Resource\BaseCollection;

class FormDataCollection extends BaseCollection
{

    public function toArray($request)
    {
        return $this->collection;
    }

}
