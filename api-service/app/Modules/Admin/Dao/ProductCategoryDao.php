<?php

namespace App\Modules\Admin\Dao;

use App\Model\ProductCategory;
use App\Model\SystemFile;

class ProductCategoryDao extends ProductCategory
{
    
    protected array $fillable = [
        'pid',
        'name',
        'sort',
        'file_id',
        'is_show',
    ];

    public function hasChild(int $id):bool
    {
        return $this->where('pid', $id)->exists();
    }

    public function File(){
        return $this->hasOne(SystemFile::class,'id','file_id');
    }

}