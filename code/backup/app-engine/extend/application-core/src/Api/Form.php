<?php

namespace DevEngine\Core\Api;

use DevEngine\Core\Resource\FormDataCollection;
use DevEngine\Core\Resource\FormDataResource;
use DevEngine\Core\Resource\FormResource;

class Form extends Api
{

    public function list($id)
    {
        $formInfo = \DevEngine\Core\Service\Form::form($id);
        $data = new \DevEngine\Core\Model\FormData();
        $data = $data->where('status', 1)->where('form_id', $id);
        $res = new FormDataCollection($data->paginate());
        return $this->success($res);
    }

    public function info($id)
    {
        [$info, $formInfo] = \DevEngine\Core\Service\Form::info($id);
        return $this->success(new FormDataResource($info));
    }

    public function push($id)
    {
        $key = request('key');
        if (!$key) {
            return $this->error('缺少验证码参数');
        }
        $formInfo = \DevEngine\Core\Service\Form::push($id, $key);
        return $this->success(new FormResource($formInfo));
    }

}
