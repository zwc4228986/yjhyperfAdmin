<?php
use App\Constants\ErrorCode;
use App\Exception\YjException;
use Hyperf\Context\Context;

if (!function_exists('isJson')) {
    function isJson($msg)
    {
        if (!is_string($msg)) {
            return false;
        }
        return is_array(json_decode($msg, true));
    }
}
