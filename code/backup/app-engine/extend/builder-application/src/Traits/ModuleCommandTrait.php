<?php

namespace Builder\Application\Traits;

trait ModuleCommandTrait
{
    /**
     * 获取应用源码模块的名称
     *
     * @return string
     */
    public function getModuleName()
    {
        $module = $this->argument('module') ?: app('builder-application')->getUsedNow();

        $module = app('builder-application')->findOrFail($module);

        return $module->getStudlyName();
    }
}
