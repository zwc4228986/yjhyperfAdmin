<?php
namespace App\Modules\Web\Helper;

if (!function_exists('isLogin')) {

    function isLogin():bool
    {
        return getUserID()>0;
    }
}
