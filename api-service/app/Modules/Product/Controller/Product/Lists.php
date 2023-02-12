<?php

namespace App\Modules\Product\Controller\Product;

use App\Modules\Admin\Logic\Product\ProductLogic;
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
    public function index()
    {
        $params = getParams();
        $product_category_pid = $params->get('product_category_pid', 0);
        $data = $this->productLogic->lists($params);
        Success($data);
    }
}