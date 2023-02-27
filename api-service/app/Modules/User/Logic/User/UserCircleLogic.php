<?php
/**
 * @Notes:【】
 * @Date: 2023-02-26 17:39
 */

namespace App\Modules\User\Logic\User;

use App\Modules\Circle\Dao\CircleCollectDao;
use App\Modules\Circle\Dao\CircleDao;
use Hyperf\Di\Annotation\Inject;

class UserCircleLogic
{
    #[Inject]
    protected CircleCollectDao $circleCollectDao;

    protected CircleDao $circleDao;

    public function lists(int $userId)
    {
        $circle_ids = $this->circleCollectDao->wher('user_id', $userId)->plick('circle_id');
        return $this->circleDao->whereIn('id', $circle_ids->toArray())->get();
    }
}