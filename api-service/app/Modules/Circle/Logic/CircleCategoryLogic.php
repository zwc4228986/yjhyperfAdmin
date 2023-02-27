<?php

namespace App\Modules\Circle\Logic;

use App\Modules\Circle\Dao\CircleCategoryDao;
use Hyperf\Di\Annotation\Inject;

class CircleCategoryLogic
{
    #[Inject]
    protected CircleCategoryDao $circleCategoryDao;

    public function lists(){
        return $this->circleCategoryDao->lists();
    }

    public function tree()
    {
        return $this->circleCategoryDao->with('Circle')->get();
    }

}