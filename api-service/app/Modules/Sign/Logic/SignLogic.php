<?php
/**
 * @Notes:【】
 * @Date: 2023-02-18 13:49
 */

namespace App\Modules\Sign\Logic;

use App\Model\UserIntegralLog;
use App\Modules\Sign\Dao\SignDao;
use App\Modules\User\Dao\UserDao;
use Hyperf\Di\Annotation\Inject;

class SignLogic
{
    #[Inject]
    public SignDao $signDao;

    #[Inject]
    public UserDao $userDao;

    #[Inject]
    public UserIntegralLog $userIntegralLog;

    public function lists()
    {
        return $this->signDao->get();
    }

    public function getSignNumber($userId)
    {
        return $this->signDao->getSignNum($userId);
    }

    public function sign(int $userId)
    {
        $count = $this->getSignNumber($userId);

        if ($count >= 5) {
            Error('每日最多签到5次');
        }
        $point = $this->signDao->where('times', $count)->value('point');
        if ($point) {
            $this->userDao->opAccount($userId, 'integral', $point, 'sign');
        } else {
            Error('每日最多签到5次');
        }
        return $point;
    }
}