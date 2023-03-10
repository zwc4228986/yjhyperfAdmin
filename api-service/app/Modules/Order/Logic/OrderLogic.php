<?php
/**
 * @Notes:【】
 * @Date: 2023-01-31 22:33
 */

namespace App\Modules\Order\Logic;

use App\Model\OrderProduct;
use App\Modules\Order\Dao\OrderDao;
use App\Modules\User\Dao\UserDao;
use App\Modules\Web\Dao\Product\ProductDao;
use Hyperf\DbConnection\Db;
use Hyperf\Di\Annotation\Inject;
use PhpParser\Error;

class OrderLogic
{
    #[Inject]
    protected ProductDao $productDao;

    #[Inject]
    protected UserDao $userDao;

    #[Inject]
    protected OrderDao $orderDao;

    public function buy(int $userId, int $product_id)
    {
        $product = $this->productDao->where('id', $product_id)->first();


        $product_price = $product->price;
        if($this->userDao->isVip($userId)){
            $product_price = 0;
        }

        Db::beginTransaction();
        try {
            $order = $this->orderDao->create([
                'order_sn' => uniqid() . rand(1000, 9999),
                'user_id' => $userId,
                'price' => $product_price,
            ]);

            $orderProductData = [new OrderProduct([
                'user_id' => $userId,
                'product_id' => $product_id,
                'price' => $product_price,
            ])];

            $order->OrderProduct()->saveMany($orderProductData);

            //判断是否足够多的币
            $this->userDao->opAccount($userId, 'integral', -$product_price, 'buy_product');

            Db::commit();
        } catch (\Exception $exception) {
            Db::rollBack();
            Error($exception->getMessage());
        }
        return $order;
    }

    public function lists(\Hyperf\Utils\Collection $params)
    {
        $data = $this->orderDao->newSelf()->params($params)->orderByDesc('id')->with(['OrderProduct' => function ($query) {
            $query->with(['Product' => function ($query) {
                $query->with('Image');
            }]);
        }])->getList();
        dump($data->toArray());

        return $data;
    }
}