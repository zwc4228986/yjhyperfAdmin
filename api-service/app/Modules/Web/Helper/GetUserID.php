<?php
namespace App\Modules\Web\Helper;

use Hyperf\Context\Context;

if (!function_exists('getUserID')) {

    function getUserID():int
    {
        return Context::get('user_id',0);
    }
}
