<?php

namespace DevEngine\Core\Resource;

use DevEngine\Core\Resource\BaseResource;

class FormDataResource extends BaseResource
{

    public function toArray($request): array
    {
        return $this->data;
    }
}
