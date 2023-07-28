<?php

namespace DevEngine\Core\Model;

/**
 * Class Api
 * @package DevEngine\Core\Model
 */
class Api extends \DevEngine\Core\Model\Base
{

    protected $table = 'api';

    protected $primaryKey = 'api_id';

    public $timestamps = false;

    protected $guarded = [];

    /**
     * 获取平台类型
     * @return array
     */
    public static function getPlatformType()
    {
        return [
            'h5' => 'H5',
            'wechat' => '微信公众号',
            'weapp' => '微信小程序',
            'app' => 'APP',
            'web' => '电脑'
        ];
    }

}
