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

    public function getProductOrderId($productId, $userId)
    {
        return $this->orderProductDao->getProductOrderId($productId, $userId);
    }

    public function download_detail(int $order_product_id)
    {
        $data = $this->orderProductDao->with(['ProductResource' => function ($query) {
            $query->with('File');

        }, 'Product' => function ($query) {
            $query->with('Image');
        }])->where('id', $order_product_id)->first();
        return $data;
    }

}