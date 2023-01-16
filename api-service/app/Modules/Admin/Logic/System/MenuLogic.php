<?php

namespace App\Modules\Admin\Logic\System;

use App\Modules\Admin\Dao\SystemMenuDao;
use Hyperf\Di\Annotation\Inject;

class MenuLogic
{
    #[Inject]
    protected SystemMenuDao $systemMenuDao;

    public function lists(array $params = []){

    }

    public function getListsByAdminId(int $adminId){
        return $this->systemMenuDao->setAdminId($adminId)->get();
    }
}