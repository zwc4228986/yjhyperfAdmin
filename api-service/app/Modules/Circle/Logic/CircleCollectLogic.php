<?php
/**
 * @Notes:【】
 * @Date: 2023-02-24 22:23
 */

namespace App\Modules\Circle\Logic;

use App\Modules\Circle\Dao\CircleCollectDao;
use Hyperf\Di\Annotation\Inject;

class CircleCollectLogic
{
    #[Inject]
    protected CircleCollectDao $circleCollectDao;

    public function collect(int $circleId, int $userId)
    {
        return $this->circleCollectDao->collect($circleId, $userId);
    }
}