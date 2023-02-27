<?php

namespace App\Modules\Circle\Model;

use App\Model\CircleCategory;
use Hyperf\Database\Model\Events\Updated;

class CircleCategoryModel extends CircleCategory
{
    protected array $fillable = [
        'name'
    ];

    public function Circle(){
        return $this->hasMany(CircleModel::class,'circle_category_id','id');
    }

}
