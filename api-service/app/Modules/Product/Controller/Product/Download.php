<?php

namespace App\Modules\Product\Controller\Product;

use App\Modules\Admin\Logic\Product\ProductLogic;
use App\Modules\Order\Logic\OrderProductLogic;
use App\Modules\Web\Middlewares\MustAuthMiddlerware;
use Hyperf\Di\Annotation\Inject;
use Hyperf\HttpServer\Annotation\Middleware;
use YjHyperfAdminPligin\Apidog\Annotations\Api;
use YjHyperfAdminPligin\Apidog\Annotations\ApiParam;
use YjHyperfAdminPligin\Apidog\Annotations\ApiPost;
use function App\Modules\Web\Helper\getUserID;

#[Api("api/product/download")]
#[Middleware(MustAuthMiddlerware::class)]
class Download
{
    #[Inject]
    protected ProductLogic $productLogic;

    #[Inject]
    protected OrderProductLogic $orderProductLogic;

    #[ApiPost("detail")]
    #[ApiParam("product_id")]
    public function index()
    {
        $params = getParams();
        $userId = getUserID();
        $data = $this->productLogic->detail($params->get('product_id'));
        $data->is_buy = $this->orderProductLogic->isBuy($params->get('product_id'), $userId);
        Success($data);
    }
}