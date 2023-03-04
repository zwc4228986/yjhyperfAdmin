<?php

namespace App\Modules\Order\Model;

use App\Model\ProductResource;

class ProductResourceModel extends ProductResource
{
    public function File()
    {
        return $this->hasOne(SystemFileModel::class, 'id', 'file_id');
    }

    public function Product()
    {
        return $this->hasOne(\App\Model\Product::class, 'id', 'product_id');
    }
}