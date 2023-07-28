<?php

namespace DevEngine\Core\Exceptions;

use Exception;

class ErrorException extends Exception
{
    public $code = 500;
    public $message = '';
    public $url = '';

    public function __construct($msg = '', $code = 500, $url = '')
    {
        parent::__construct();
        $this->message = $msg;
        $this->code = $code;
        $this->url = $url;
    }

    public function render($request)
    {
        $result = [
            'code' => $this->code,
            'msg' => $this->message,
            'url' => $this->url
        ];
        return response()->view('application-core::error', $result, $this->code);
    }

}