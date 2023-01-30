<?php

namespace App\Modules\Admin\Dao;

use App\Model\ProductDescription;

class ProductDescriptionDao extends ProductDescription
{
    protected array $fillable = [
        'product_id',
        'description',
    ];
}