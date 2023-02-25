<?php

namespace App\Modules\Circle\Logic;

use App\Model\CircleCollect;
use App\Modules\Admin\Dao\CircleDao;
use App\Modules\Circle\Dao\CircleCollectDao;
use Hyperf\Di\Annotation\Inject;

class CircleLogic
{
    #[Inject]
    protected CircleDao $circleDao;

    #[Inject]
    protected CircleCollectDao $circleCollectDao;

    public function lists()
    {
        return $this->circleDao->getList();
    }

    public function detail(int $circleId, int $userId)
    {
        $detail = $this->circleDao->detail($circleId);
        $detail->is_collect = $this->circleCollectDao->isCollect($circleId, $userId);
        return $detail;
    }


}