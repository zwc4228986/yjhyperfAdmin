<?php

namespace App\Context;

class Context
{
    public static function userInfo():UserInfoContext
    {
        return \Hyperf\Context\Context::get('userInfo')??(new UserInfoContext());
    }

}