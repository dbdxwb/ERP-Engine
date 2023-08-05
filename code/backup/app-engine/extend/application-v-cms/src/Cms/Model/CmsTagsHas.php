<?php

namespace Modules\Cms\Model;


/**
 * class CmsTagsHas
 * @package Modules\Cms\Model
 */
class CmsTagsHas extends \DevEngine\Core\Model\Base
{

    protected $table = 'cms_tags_has';

    public function tag()
    {
        return $this->belongsTo(CmsTags::class, 'tag_id', 'tag_id');
    }
}
