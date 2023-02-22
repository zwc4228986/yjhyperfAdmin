<?php

namespace App\Modules\Circle\Logic;

use App\Modules\Admin\Dao\CircleDao;
use Hyperf\Di\Annotation\Inject;

class CircleLogic
{
    #[Inject]
    protected CircleDao $circleDao;

    public function lists(){
        return $this->circleDao->getList();
    }

}