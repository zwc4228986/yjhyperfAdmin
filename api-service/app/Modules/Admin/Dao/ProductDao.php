<?php

namespace App\Modules\Admin\Dao;

use App\Model\Product;

class ProductDao extends Product
{
    protected array $fillable = [
        'name',
        'price',
        'status',
        'image_id',
        'image_ids',
    ];
}