<?php
/**
 * @Notes:【】
 * @Date: 2023-02-25 16:51
 */

namespace App\Modules\Order\Logic;


use App\Modules\Order\Dao\OrderProductDao;
use Hyperf\Di\Annotation\Inject;

class OrderProductLogic
{
    #[Inject]
    protected OrderProductDao $orderProductDao;

    public function isBuy($productId, $userId)
    {
        return $this->orderProductDao->isBuy($productId, $userId);
    }
}