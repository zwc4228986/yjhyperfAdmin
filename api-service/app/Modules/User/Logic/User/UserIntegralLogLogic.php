<?php
/**
 * @Notes:【】
 * @Date: 2023-02-20 22:13
 */

namespace App\Modules\User\Logic\User;


use App\Modules\User\Dao\UserIntegralLogDao;
use Hyperf\Di\Annotation\Inject;

class UserIntegralLogLogic
{
    #[Inject]
    protected UserIntegralLogDao $userIntegralLogDao;

    public function lists()
    {
        return $this->userIntegralLogDao->orderByDesc('id')->getList();
    }
}