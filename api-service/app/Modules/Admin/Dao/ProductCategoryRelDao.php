<?php

namespace App\Modules\Admin\Dao;

use App\Model\ProductCategoryRel;

class ProductCategoryRelDao extends ProductCategoryRel
{
    protected array $fillable = [
      'product_id',
      'product_category_id',
      'product_category_pid',
    ];
}