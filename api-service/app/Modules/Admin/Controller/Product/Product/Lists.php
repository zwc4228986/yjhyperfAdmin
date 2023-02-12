<?php

namespace App\Modules\Admin\Controller\Product\Product;

use App\Modules\Admin\Logic\Product\ProductLogic;
use Hyperf\Di\Annotation\Inject;
use YjHyperfAdminPligin\Apidog\Annotations\Api;
use YjHyperfAdminPligin\Apidog\Annotations\ApiPost;

#[Api("admin/product/lists")]
class Lists
{
    #[Inject]
    protected ProductLogic $productLogic;

    #[ApiPost]
    public function index()
    {
        $data = $this->productLogic->lists(collect([]));
        Success($data);
    }
}