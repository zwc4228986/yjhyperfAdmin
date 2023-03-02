<?php

namespace App\Modules\Product\Controller\Product;


use App\Modules\Order\Logic\OrderProductLogic;
use App\Modules\Product\Logic\ProductLogic;
use App\Modules\Web\Middlewares\MustAuthMiddlerware;
use Hyperf\Di\Annotation\Inject;
use Hyperf\HttpServer\Annotation\Middleware;
use YjHyperfAdminPligin\Apidog\Annotations\Api;
use YjHyperfAdminPligin\Apidog\Annotations\ApiParam;
use YjHyperfAdminPligin\Apidog\Annotations\ApiPost;
use function App\Modules\Web\Helper\getUserID;

#[Api("api/product/detail")]
#[Middleware(MustAuthMiddlerware::class)]
class Detail
{
    #[Inject]
    protected ProductLogic $productLogic;

    #[Inject]
    protected OrderProductLogic $orderProductLogic;

    #[ApiPost]
    #[ApiParam("product_id")]
    public function index()
    {
        $params = getParams();
        $userId = getUserID();
        $data = $this->productLogic->detail($params->get('product_id'));
        $order_product_id = $this->orderProductLogic->getProductOrderId($params->get('product_id'), $userId);
        $data->is_buy = (bool)$order_product_id;
        $data->order_product_id = $order_product_id;
        Success($data);
    }
}