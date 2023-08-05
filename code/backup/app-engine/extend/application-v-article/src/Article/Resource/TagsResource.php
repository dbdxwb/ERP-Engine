<?php

namespace Modules\Article\Resource;

use DevEngine\Core\Resource\BaseResource;

class TagsResource extends BaseResource
{

    public function toArray($request): array
    {
        return [
            'name' => $this->tag->name,
            'count' => $this->tag->count,
            'view' => $this->tag->view,
        ];
    }
}
