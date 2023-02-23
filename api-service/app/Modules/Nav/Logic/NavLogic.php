<?php

namespace App\Modules\Nav\Logic;

use App\Modules\Nav\Dao\NavDao;
use Hyperf\Di\Annotation\Inject;

class NavLogic
{

    #[Inject]
    protected NavDao $navDao;

    public function lists(\Hyperf\Utils\Collection $params)
    {
        return $this->navDao->lists($params);
    }
}