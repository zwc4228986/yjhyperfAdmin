<?php

namespace App\Model\Trait;

use App\Model\Model;
use App\Model\OrderProduct;

class Order extends Model
{
    public function OrderProducts(){
        return $this->hasMany(OrderProduct::class,'order_id','id');
    }

    public function OrderProduct(){
        return $this->hasOne(OrderProduct::class,'order_id','id');
    }
}