<?php

namespace App\Modules\Admin\Model;

use App\Model\CircleCategory;

class CircleCategoryModel extends CircleCategory
{
    public function Circle(){
        return $this->hasMany(CircleModel::class,'circle_category_id','id');
    }

}