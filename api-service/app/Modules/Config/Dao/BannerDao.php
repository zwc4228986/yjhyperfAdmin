<?php

namespace App\Modules\Config\Dao;

use App\Modules\Config\Model\BannerModel;
use YjHyperfAdminPligin\Framework\Dao\DaoTrait;

class BannerDao extends BannerModel
{
    use DaoTrait;

    public function lists()
    {
        return $this->newSelf()->with('Image')->getList();
    }
}