<?php

namespace App\Model\Trait;

use App\Model\Model;
use App\Model\ProductCategoryRel;
use App\Model\ProductDescription;

class Product extends Model
{
    public function Image(){
        return $this->hasOne(\App\Model\SystemFile::class,'id','image_id')->withDefault(function($item){
            return App(\App\Model\SystemFile::class)->where('suffix','png')->first();
        });
    }
    
    public function Description(){
        return $this->hasOne(ProductDescription::class,'product_id','id');
    }

    public function ProductCategoryRel(){
        return $this->hasMany(ProductCategoryRel::class,'product_id','id');
    }

    public function ProductDescription(){
        return $this->hasOne(ProductDescription::class,'product_id','id');
    }

    public function ProductResource(){
        return $this->hasOne(\App\Model\ProductResource::class,'product_id','id');
    }
}