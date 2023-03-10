<?php

namespace App\Modules\Admin\Dao;


use App\Modules\Admin\Model\BannerModel;
use YjHyperfAdminPligin\Framework\Dao\DaoTrait;

class BannerDao extends BannerModel
{
    use DaoTrait;

    public function lists()
    {
        return $this->newSelf()->daoWith('Image')->getList();
    }

    public function add(\Hyperf\Utils\Collection $params)
    {
        return $this->create($params->toArray());
    }

    public function edit($id, \Hyperf\Utils\Collection $params)
    {
        $dao = $this->newSelf()->where('id', $id)->first();
        $dao->fill($params->toArray());
        return $dao->save();
    }

}