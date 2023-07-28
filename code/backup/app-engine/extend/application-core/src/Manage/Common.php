<?php

namespace DevEngine\Core\Manage;

use DevEngine\Core\UI\Widget\Icon;
use DevEngine\Core\Util\View;

/**
 * 管理端基础接口
 * @package DevEngine\Core\Model
 */
trait Common
{

    protected array $assign = [];

    /**
     * 模板赋值
     * @param $name
     * @param $value
     */
    public function assign($name, $value): void
    {
        $this->assign[$name] = $value;
    }

    /**
     * @param string $tpl
     * @return mixed
     */
    public function systemView(string $tpl = '')
    {
        return (new View($tpl, $this->assign))->render();
    }

    /**
     * @param array $node
     * @return array|\Illuminate\Http\JsonResponse|\Illuminate\Http\Resources\Json\JsonResource
     */
    public function systemNode(array $node = [])
    {
        return app_success('ok', [
            'node' => [
                'nodeName' => 'app-layout',
                'child' => $node
            ]
        ]);
    }

    /**
     * @param string $title
     * @param array  $node
     * @return array|\Illuminate\Http\JsonResponse|\Illuminate\Http\Resources\Json\JsonResource
     */
    public function dialogNode(string $title = '', array $node = [])
    {
        return app_success('ok', [
            'node' => [
                'nodeName' => 'app-dialog',
                'title' => $title,
                'child' => $node
            ]
        ]);
    }

    /**
     * @param $name
     * @throws \DevEngine\Core\Exceptions\ErrorException
     */
    public function can($name)
    {
        $parsing = app_parsing();
        $route = request()->route()->getName();
        if (!auth(strtolower($parsing['layer']))->user()->can($route . '|' . $name)) {
            app_error('没有权限使用该功能', 403);
        }
    }

    /**
     * @return array
     */
    public function getAssign(): array
    {
        return $this->assign;
    }
}
