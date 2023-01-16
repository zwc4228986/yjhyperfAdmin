<?php

namespace App\Modules\Admin\Dao;


use App\Model\SystemMenu;
use YjHyperfAdminPligin\Framework\Dao\AddWhereQueryTrait;

class SystemMenuDao extends SystemMenu
{
    use AddWhereQueryTrait;

    public function setAdminId(int $adminId):self
    {
        if($adminId != 1){
             $this->addWhere($this::query()->whereIn('id',$this->getAdminMenusId($adminId)));
        }
        return $this;
    }

    private function getAdminMenusId($adminId):Array
    {
        $rolesId = 1;
        $menu_ids =  App(SystemRolesMenuDao::class)->where('roles_id',$rolesId)
            ->pluck('menu_id')->toArray();
        return $menu_ids;
    }
}