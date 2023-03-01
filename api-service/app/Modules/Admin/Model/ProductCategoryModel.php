<?php

namespace App\Modules\Admin\Model;

use App\Model\ProductCategory;
use App\Model\SystemFile;

class ProductCategoryModel extends ProductCategory
{
    protected array $fillable = [
        'pid',
        'name',
        'sort',
        'file_id',
        'is_show',
        'circle_id'
    ];

    public function File(){
        return $this->hasOne(SystemFile::class,'id','file_id');
    }

}