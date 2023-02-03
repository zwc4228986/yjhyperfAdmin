<?php

namespace App\Modules\Product\Controller\Product;

use App\Modules\Admin\Logic\Product\ProductLogic;
use Hyperf\Di\Annotation\Inject;
use YjHyperfAdminPligin\Apidog\Annotations\Api;
use YjHyperfAdminPligin\Apidog\Annotations\ApiPost;

#[Api("api/product/lists")]
class Lists
{
    #[Inject]
    protected ProductLogic $productLogic;

    #[ApiPost]
    public function index()
    {
        $data = $this->productLogic->lists([]);
        Success($data);
    }
}