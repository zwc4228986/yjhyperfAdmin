<?php
/**
 * @Notes:【】
 * @Date: 2023-02-25 16:52
 */

namespace App\Modules\Order\Dao;

use App\Modules\Order\Model\OrderProductModel;

class OrderProductDao extends OrderProductModel
{
    public function isBuy(int $productId, int $userId = 0): bool
    {
        if ($userId == 0) {
            return false;
        }
        return $this->where('product_id', $productId)->where('user_id', $userId)->exists();
    }

    public function getProductOrderId(int $productId, int $userId = 0):int
    {
        return $this->where('product_id', $productId)->where('user_id', $userId)->value('id')??0;
    }
}