<?php

namespace App\Modules\User\Logic\User;

use App\Modules\User\Dao\UserDao;
use Hyperf\Di\Annotation\Inject;

class UserCreateLogic
{
    #[Inject]
    protected UserDao $userDao;

    public function a(){
        dd($this->userDao);
    }
}