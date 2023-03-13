<?php
/**
 * @Notes:【】
 * @Date: 2023-03-12 16:26
 */

namespace App\Modules\Activity\Logic;

use App\Modules\Activity\Dao\UserDao;
use Hyperf\Di\Annotation\Inject;

class VipLogic
{
    #[Inject]
    protected UserDao $userDao;

    public function send($userId, $day = 7)
    {
        $userDao = $this->userDao->where('id', $userId)->first();
        $overdue_time = $userDao->overdue_time;
        $new_overdue_time = time();
        if ($overdue_time > time()) {
            $new_overdue_time = $overdue_time;
        }
        $new_overdue_time = $new_overdue_time + $day * 3600 * 24;
        $userDao->fill([
            'overdue_time' => $new_overdue_time,
            'vip_status' => 3
        ]);

        return $userDao->save();
    }
}