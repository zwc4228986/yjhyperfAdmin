<?php

namespace App\Model\Trait;

use App\Model\Model;

class OrderProduct extends Model
{
    protected array $fillable = [
        'order_id',
        'user_id',
        'product_id',
        'price',
    ];
}