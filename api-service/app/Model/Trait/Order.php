<?php

namespace App\Model\Trait;

use App\Model\Model;
use App\Model\OrderProduct;

class Order extends Model
{
    public function OrderProduct(){
        return $this->hasMany(OrderProduct::class,'order_id','id');
    }
}