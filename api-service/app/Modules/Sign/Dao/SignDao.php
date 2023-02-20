<?php
/**
 * @Notes:【】
 * @Date: 2023-02-18 13:48
 */

namespace App\Modules\Sign\Dao;

use App\Model\UserIntegralLog;
use App\Modules\Sign\Model\SignModel;

class SignDao extends SignModel
{
    public function getSignNum($userId)
    {
        $count = app(UserIntegralLog::class)
            ->yjRangeTime('create_time', 'today')
            ->where('user_id', $userId)
            ->where('type', 'sign')
            ->count();
        return $count;
    }
}