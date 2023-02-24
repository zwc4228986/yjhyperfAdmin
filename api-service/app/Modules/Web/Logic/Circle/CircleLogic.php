<?php

namespace App\Modules\Web\Logic\Circle;

class CircleLogic
{
    public function lists(){
        return $this->circleDao->getList();
    }
}