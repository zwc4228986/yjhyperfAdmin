<?php

namespace App\Modules\Admin\Controller\Product\Product;

use App\Modules\Admin\Logic\Product\ProductLogic;
use Hyperf\Di\Annotation\Inject;
use YjHyperfAdminPligin\Apidog\Annotations\Api;
use YjHyperfAdminPligin\Apidog\Annotations\ApiParam;
use YjHyperfAdminPligin\Apidog\Annotations\ApiPost;

#[Api("admin/product/detail")]
class Detail
{
    #[Inject]
    protected ProductLogic $productLogic;

    #[ApiPost]
    #[ApiParam("product_id")]
    public function index()
    {
        $params = getParams();
        $data = $this->productLogic->detail($params->get('product_id'));
        Success($data);
    }
}