<?php
/**
 * @Notes:【】
 * @Date: 2023-02-24 22:39
 */

namespace App\Modules\Circle\Dao;

use App\Modules\Circle\Model\CircleCollectModel;

class CircleCollectDao extends CircleCollectModel
{

    public function collect(int $circleId, $userId)
    {
        $dao = $this->where('circle_id', $circleId)->where('user_id', $userId)->first();
        if (!$dao) {
            $this->create([
                'circle_id' => $circleId,
                'user_id' => $userId
            ]);
        } else {
            $dao->delete();
        }
        return true;
    }

    public function isCollect(int $circleId, int $userId): bool
    {
        if ($userId == 0) {
            return false;
        }
        return $this->where('circle_id', $circleId)->where('user_id', $userId)->exists();
    }
}