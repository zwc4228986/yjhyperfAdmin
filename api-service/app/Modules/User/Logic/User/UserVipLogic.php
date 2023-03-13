<?php
/**
 * @Notes:【】
 * @Date: 2023-03-11 22:42
 */

namespace App\Modules\User\Logic\User;

use App\Modules\User\Model\UserVipPrivilegeDao;
use Hyperf\Di\Annotation\Inject;

class UserVipLogic
{
    #[Inject]
    protected UserVipPrivilegeDao $userVipPrivilegeDao;

    public function privilege()
    {
        return $this->userVipPrivilegeDao->lists();
    }
}