<?php
namespace App\Modules\Web\Helper;
use Hyperf\Context\Context;

if (!function_exists('getUserInfo')) {

    function getUserInfo():int
    {
        $userId = getUserID();

    }
}
