<?php

namespace App\Modules\Circle\Logic;

use App\Modules\Admin\Dao\CircleCategoryDao;
use Hyperf\Di\Annotation\Inject;

class CircleCategoryLogic
{
    #[Inject]
    protected CircleCategoryDao $circleCategoryDao;

    public function lists(){
        return $this->circleCategoryDao->lists();
    }

}