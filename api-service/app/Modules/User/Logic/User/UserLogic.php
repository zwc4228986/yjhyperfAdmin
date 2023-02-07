<?php
/**
 * @Notes:【】
 * @Date: 2023-02-08 0:03
 */

namespace App\Modules\User\Logic\User;

use App\Modules\User\Dao\UserDao;
use Hyperf\Di\Annotation\Inject;

class UserLogic
{
    #[Inject]
    protected UserDao $userDao;

    public function detail($userId)
    {
        return $this->userDao->read($userId);
    }
}