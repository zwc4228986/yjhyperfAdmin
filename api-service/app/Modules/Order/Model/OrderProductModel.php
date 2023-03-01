<?php
/**
 * @Notes:【】
 * @Date: 2023-02-25 16:52
 */

namespace App\Modules\Order\Model;

use App\Model\OrderProduct;
use App\Model\Product;
use App\Model\ProductResource;

class OrderProductModel extends OrderProduct
{
    public function ProductResource()
    {
        return $this->hasMany(ProductResourceModel::class, 'product_id', 'product_id');
    }

    public function Product()
    {
        return $this->hasOne(ProductModel::class, 'id', 'product_id');
    }
}