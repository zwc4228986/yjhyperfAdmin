<?php

namespace App\Modules\Admin\Logic\Circle;

use App\Modules\Admin\Dao\CircleCategoryDao;
use Hyperf\Di\Annotation\Inject;

class CircleCategoryLogic
{
    #[Inject]
    protected CircleCategoryDao $circleCategoryDao;

    public function lists(){
        return $this->circleCategoryDao->lists();
    }

    public function add(\Hyperf\Utils\Collection $params)
    {
        return $this->circleCategoryDao->add($params);
    }

    public function edit(int $id,\Hyperf\Utils\Collection $params){
        return $this->circleCategoryDao->edit($id,$params);
    }

    public function del(int $id){
        return $this->circleCategoryDao->del($id);
    }

}