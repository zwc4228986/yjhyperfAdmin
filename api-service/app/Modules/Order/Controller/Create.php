<?php

namespace App\Modules\Order\Controller;

use App\Modules\Order\Logic\OrderLogic;
use App\Modules\Web\Logic\Product\ProductLogic;
use App\Modules\Web\Middlewares\MustAuthMiddlerware;
use Hyperf\Di\Annotation\Inject;
use Hyperf\HttpServer\Annotation\Middleware;
use YjHyperfAdminPligin\Apidog\Annotations\Api;
use YjHyperfAdminPligin\Apidog\Annotations\ApiParam;
use YjHyperfAdminPligin\Apidog\Annotations\ApiPost;
use function App\Modules\Web\Helper\getUserID;

#[Api('api/order/create')]
#[Middleware(MustAuthMiddlerware::class)]
class Create
{
    #[Inject]
    protected ProductLogic $productLogic;

    #[Inject]
    protected OrderLogic $orderLogic;

    #[ApiPost]
    #[ApiParam('product_id')]
    public function index()
    {
        $userId = getUserID();
        $params = getParams();
//        $this->productLogic->buy($userId,$params->get('product_id'));
        $order = $this->orderLogic->buy($userId, $params->get('product_id'));
        Success($order);
    }
}