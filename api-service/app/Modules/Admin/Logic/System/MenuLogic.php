<?php

namespace App\Modules\Admin\Logic\System;

use App\Modules\Admin\Dao\SystemMenuDao;
use Hyperf\Di\Annotation\Inject;
use Hyperf\Utils\Collection;

class MenuLogic
{
    #[Inject]
    protected SystemMenuDao $systemMenuDao;

    public function lists(array $params = [])
    {
        $data = $this->systemMenuDao->orderBy('sort')->get();
        $except = ['active','icon','params','type','title','hidden','position'];
        $data->transform(function ($item) use ($except) {
            $item = collect($item);
            $item->offsetSet('meta', $item->only($except));
            return $item;
        });
        return $data;
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

    public function edit($id, Collection $params)
    {

        $this->systemMenuDao->check($id,$params);

        $systemMenuData = $this->systemMenuDao->where('id',$id)->first();

        $params->except('name');
        if($path = $params->get('path')){
            $params->offsetSet('name',implode(array_map('ucwords',explode('/',$path))));
        }
        
        $systemMenuData->fill($params->toArray());
        return $systemMenuData->save();
    }

    public function add(Collection $params)
    {
        $this->systemMenuDao->check(0,$params);
        return $this->systemMenuDao->create($params->toArray());
    }
}