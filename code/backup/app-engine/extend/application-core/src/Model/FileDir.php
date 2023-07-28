<?php

namespace DevEngine\Core\Model;

/**
 * Class FileDir
 * @package DevEngine\Core\Model
 */
class FileDir extends \DevEngine\Core\Model\Base
{

    protected $table = 'file_dir';

    protected $primaryKey = 'dir_id';

    public $timestamps = false;


}
