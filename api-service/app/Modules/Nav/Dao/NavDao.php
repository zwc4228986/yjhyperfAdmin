<?php

namespace App\Modules\Nav\Dao;

use App\Modules\Nav\Model\NavModel;
use Hyperf\Utils\Collection;
use YjHyperfAdminPligin\Framework\Dao\DaoTrait;

//

class NavDao extends NavModel
{
    use DaoTrait;

    public function params(Collection $params)
    {
        $params->check('circle_id',function($circle_id){
            $this->addWhere($this->getQuery()->where('circle_id',$circle_id));
        });
        return $this;
    }

    public function lists(\Hyperf\Utils\Collection $params)
    {
        return $this->newSelf()->params($params)->getList();
    }
}