<?php

namespace App\Modules\Admin\Dao;

use App\Modules\Admin\Model\ProductCategoryModel;
use YjHyperfAdminPligin\Framework\Dao\DaoTrait;

class ProductCategoryDao extends ProductCategoryModel
{
    use DaoTrait;

    public function hasChild(int $id): bool
    {
        return $this->where('pid', $id)->exists();
    }

    public function params($params)
    {
        $params->check('circle_id', function ($circle_id) {
            $this->addWhere($this->getQuery()->where('circle_id', $circle_id));
        });
        return $this;
    }

}