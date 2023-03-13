<?php

namespace App\Modules\Product\Controller\Product;

use App\Model\Product;
use App\Modules\Product\Logic\ProductLogic;
use App\Modules\Web\Middlewares\MustAuthMiddlerware;
use Hyperf\Di\Annotation\Inject;
use Hyperf\HttpServer\Annotation\Middleware;
use YjHyperfAdminPligin\Apidog\Annotations\Api;
use YjHyperfAdminPligin\Apidog\Annotations\ApiParam;
use YjHyperfAdminPligin\Apidog\Annotations\ApiPost;
use function App\Modules\Web\Helper\getUserID;

#[Api("api/product/lists")]
#[Middleware(MustAuthMiddlerware::class)]
class Lists
{
    #[Inject]
    protected ProductLogic $productLogic;

    #[ApiPost]
    #[ApiParam('product_category_pid', 'nullable')]
    #[ApiParam('circle_category_id', 'nullable')]
    #[ApiParam('product_category_id', 'nullable')]
    #[ApiParam('circle_id', 'nullable')]
    public function index()
    {
        $params = getParams();
        $userId = getUserID();
        $data = $this->productLogic->lists($params);
        Success($data);
    }
}