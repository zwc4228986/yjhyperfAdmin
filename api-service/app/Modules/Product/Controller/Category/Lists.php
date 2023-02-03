<?php

namespace App\Modules\Product\Controller\Category;

use App\Modules\Admin\Logic\Product\ProductCategoryLogic;
use Hyperf\Di\Annotation\Inject;
use YjHyperfAdminPligin\Apidog\Annotations\Api;
use YjHyperfAdminPligin\Apidog\Annotations\ApiPost;

#[Api("api/product/category/lists")]
class Lists
{
    #[Inject]
    protected ProductCategoryLogic $productCategoryLogic;

    #[ApiPost]
    public function index()
    {
        $data = $this->productCategoryLogic->getTreelists();
        Success($data);
    }

}