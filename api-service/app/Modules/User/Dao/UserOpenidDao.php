<?php

namespace App\Modules\User\Dao;

use App\Model\UserOpenid;

class UserOpenidDao extends UserOpenid
{
    protected array $fillable = [
        'user_id',
        'unionid',
        'type',
        'subscribe_scene',
        'openid',
    ];

    public function getDataByUnionId(string $unionid)
    {
        $userOpenidData =  $this->where('unionid', $unionid)->first();
        return $userOpenidData;
    }

    public function getDataByOpenid(string $type,string $openid)
    {
        return  $this->where('type', $type)->where('openid',$openid)->first();
    }
}