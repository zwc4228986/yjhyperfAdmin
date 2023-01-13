<?php

namespace App\Modules\User\Logic\User;

use Hyperf\Redis\Redis;

class TokenLogic
{
    protected $pre = 'User:';


    public function getUserId($token)
    {
        return App(Redis::class)->get($this->pre.$token);
    }
}