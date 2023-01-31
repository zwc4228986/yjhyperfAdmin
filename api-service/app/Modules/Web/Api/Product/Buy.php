<?php

namespace App\Modules\Web\Api\Product;

use App\Modules\Web\Logic\Product\ProductLogic;
use App\Modules\Web\Middlewares\MustAuthMiddlerware;
use Hyperf\Di\Annotation\Inject;
use Hyperf\HttpServer\Annotation\Middleware;
use YjHyperfAdminPligin\Apidog\Annotations\Api;
use YjHyperfAdminPligin\Apidog\Annotations\ApiParam;
use YjHyperfAdminPligin\Apidog\Annotations\ApiPost;
use function App\Modules\Web\Helper\getUserID;

#[Api('web/api/product/buy')]
#[Middleware(MustAuthMiddlerware::class)]
class Buy
{
    #[Inject]
    protected ProductLogic $productLogic;

    #[ApiPost]
    #[ApiParam('product_id')]
    public function index(){
        $userId = getUserID();
        $params = getParams();

        $this->productLogic->buy($userId,$params->get('product_id'));
    }
}