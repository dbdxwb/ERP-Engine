<?php

namespace DevEngine\Core\Traits;

/**
 * Class Form
 * @package DevEngine\Core\Traits
 */
trait Form
{
    /**
     * @return \Illuminate\Database\Eloquent\Relations\MorphOne
     */
    public function form(): \Illuminate\Database\Eloquent\Relations\MorphOne
    {
        return $this->morphOne(\DevEngine\Core\Model\FormData::class, 'has', 'has_type');
    }

    /**
     * 保存表单
     * @param $formId
     * @param $data
     * @return bool
     */
    public function formSave($formId, $data): bool
    {
        $id = $this->{$this->primaryKey};
        if (!$id || !$formId) {
            return false;
        }
        return \DevEngine\Core\Util\Form::saveForm($formId, $data, $id, get_called_class());
    }

    /**
     * 删除表单
     * @return bool
     */
    public function formDel(): bool
    {
        $id = $this->{$this->primaryKey};
        if (!$id) {
            return false;
        }
        return $this->form()->delete();
    }

}
