<?php

namespace App\Modules\Admin\Model;

use App\Model\Circle;
use App\Model\SystemFile;
use App\Modules\Product\Model\SystemFileModel;

class CircleModel extends Circle
{
    protected array $fillable = [
        'name',
        'circle_category_id',
        'sort',
        'is_show',
        'icon_id',
    ];

    public function Icon()
    {
        return $this->hasOne(SystemFileModel::class, 'id', 'icon_id');
    }

    public function ProductCategory()
    {
        return $this->hasMany(ProductCategoryModel::class, 'circle_id', 'id');
    }
}