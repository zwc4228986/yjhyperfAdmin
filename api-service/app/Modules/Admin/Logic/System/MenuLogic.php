<?php

namespace App\Modules\Admin\Logic\System;

use App\Modules\Admin\Dao\SystemMenuDao;
use Hyperf\Di\Annotation\Inject;

class MenuLogic
{
    #[Inject]
    protected SystemMenuDao $systemMenuDao;

    public function lists(array $params = [])
    {

    }

    public function getListsByAdminId(int $adminId)
    {
        $data = $this->systemMenuDao->setAdminId($adminId)->orderBy('sort')->get();
        $except = ['active', 'icon', 'params', 'type', 'title', 'hidden', 'position'];
        $data->transform(function ($item) use ($except) {
            $item = collect($item);
            $item->offsetSet('meta', $item->only($except));
            return $item;
        });
        return $data;
    }
}