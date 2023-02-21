<?php

namespace App\Modules\Admin\Logic\Circle;

use App\Modules\Admin\Dao\CircleDao;
use Hyperf\Di\Annotation\Inject;

class CircleLogic
{
    #[Inject]
    protected CircleDao $circleDao;

    public function lists(){
        return $this->circleDao->getList();
    }

    public function add(\Hyperf\Utils\Collection $params)
    {
        return $this->circleDao->add($params);
    }

    public function edit(int $id,\Hyperf\Utils\Collection $params){
        return $this->circleDao->edit($id,$params);
    }
    
    public function del(int $id)
    {
        return $this->circleDao->del($id);
    }

}