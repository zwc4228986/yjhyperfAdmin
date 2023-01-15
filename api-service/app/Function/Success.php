<?php
use App\Constants\ErrorCode;
use App\Exception\YjException;
use Hyperf\Context\Context;

if (!function_exists('Success')) {
    function Success($data = [])
    {
        throw new YjException($data, ErrorCode::CODE_SUCC, 'success');
    }
}
