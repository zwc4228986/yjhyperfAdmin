<?php

namespace App\Context;

use App\Modules\User\Dao\UserDao;
use Hyperf\Context\Context;
use Hyperf\Di\Annotation\Inject;
use YjHyperfAdminPligin\Jwt\Jwt;

class UserInfoContextHandle
{
    #[Inject]
    protected Jwt $jwt;

    #[Inject]
    protected UserDao $userDao;

    protected UserInfoContext $context;

    public function  init($token):UserInfoContext
    {
        $userId = $this->jwt->guard('user')->decode($token)->get();

        $user = $this->userDao->read($userId);
        return $this->context->setUserId($user->id)->setVipStatus($user->vip_status)->setOverdueTime($user->overdue_time);
    }
}