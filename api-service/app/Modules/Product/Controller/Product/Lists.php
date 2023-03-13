<?php

namespace App\Modules\Product\Controller\Product;

use App\Model\Product;
use App\Modules\Product\Logic\ProductLogic;
use Hyperf\Di\Annotation\Inject;
use YjHyperfAdminPligin\Apidog\Annotations\Api;
use YjHyperfAdminPligin\Apidog\Annotations\ApiParam;
use YjHyperfAdminPligin\Apidog\Annotations\ApiPost;

#[Api("api/product/lists")]
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

        $data = $this->productLogic->lists($params);
        Success($data);
    }
}