<?php
/**
 * @Notes:【】
 * @Date: 2023-03-04 17:38
 */

namespace App\Modules\Order\Model;

use App\Model\Order;

class OrderModel extends Order
{

    public function OrderProducts()
    {
        return $this->hasMany(OrderProductModel::class, 'order_id', 'id');
    }

    public function OrderProduct()
    {
        return $this->hasOne(OrderProductModel::class, 'order_id', 'id');
    }
}