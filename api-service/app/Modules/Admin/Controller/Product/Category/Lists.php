<?php

namespace App\Modules\Admin\Controller\Product\Category;

use App\Modules\Admin\Logic\Product\ProductCategoryLogic;
use Hyperf\Di\Annotation\Inject;
use YjHyperfAdminPligin\Apidog\Annotations\Api;
use YjHyperfAdminPligin\Apidog\Annotations\ApiPost;

#[Api("admin/product/category/lists")]
class Lists
{
    #[Inject]
    protected ProductCategoryLogic $productCategoryLogic;

    #[ApiPost]
    public function index(){
        $data = $this->productCategoryLogic->getTreelists(collect());
        Success($data);
    }
}