<?php

namespace App\Model\Trait;

use App\Model\Model;

class ProductResource extends Model
{
    public function File(){
        return $this->hasOne(\App\Model\SystemFile::class,'id','file_id');
    }

    public function Product(){
        return $this->hasOne(\App\Model\Product::class,'id','product_id');
    }

}