<?php
use App\Constants\ErrorCode;
use App\Exception\YjException;

if (!function_exists('Error')) {
    function Error(string $msg = '未知错误', int $code = ErrorCode::FAIL, $data = [])
    {
        if (isJson($msg)) {
            $msg = json_decode($msg, true)['message'] ?? $msg;
        }
        throw  new YjException($data, $code, $msg);
    }
}
