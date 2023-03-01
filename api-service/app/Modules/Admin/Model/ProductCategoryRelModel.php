<?php

namespace App\Modules\Admin\Model;

use App\Model\ProductCategoryRel;

class ProductCategoryRelModel extends ProductCategoryRel
{
    protected array $fillable = [
        'product_id',
        'product_category_id',
        'product_category_pid',
    ];
}