<?php

namespace App\Modules\Admin\Dao;

use App\Model\ProductResource;

class ProductResourceDao extends ProductResource
{
    protected array $fillable = [
      'product_id',
      'file_id',
      'type',
    ];
}