<?php

use Hyperf\Context\Context;

if (!function_exists('getParams')) {

    function getParams():\Hyperf\Utils\Collection
    {
        return collect(Context::get('validator.data'));
    }
}
