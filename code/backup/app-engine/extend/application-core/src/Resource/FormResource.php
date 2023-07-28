<?php

namespace DevEngine\Core\Resource;

use DevEngine\Core\Resource\BaseResource;

class FormResource extends BaseResource
{

    public function toArray($request): array
    {
        return [
            'name' => $this->name,
            'description' => $this->description,
            'audit' => $this->audit,
        ];
    }
}
