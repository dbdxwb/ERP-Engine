<?php

namespace DevEngine\Core\Admin\System;

class Upload extends Common
{
    /**
     * 强制文件驱动
     * @var string
     */
    protected string $driver = '';


    use \DevEngine\Core\Manage\Upload;
}
