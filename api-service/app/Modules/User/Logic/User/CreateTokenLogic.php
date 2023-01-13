<?php

namespace App\Modules\User\Logic\User;

use Hyperf\Redis\Redis;

class CreateTokenLogic
{
    protected $token_pre = 'User:';

    private $userId;

    private $token;

    public function __construct($userId)
    {
        $this->userId = $userId;
    }

    public static function init($userId){
        return new static($userId);
    }

    protected function createToken(){
        return  $this->token = time() . rand(10000, 9999999) . $this->userId;
    }

    public function create(){
        $this->createToken();
        $this->cacheToken();
        return $this->getToken();
    }

    protected function cacheToken(){
        return App(Redis::class)->set($this->token_pre.$this->token,$this->userId);
    }

    protected function getToken(){
        return $this->token;
    }
}