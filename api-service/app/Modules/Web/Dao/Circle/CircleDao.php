<?php

namespace App\Modules\Web\Dao\Circle;

use App\Modules\Web\Model\CircleModel;

class CircleDao extends CircleModel
{
    public function lists(){
        return $this->get();
    }
}