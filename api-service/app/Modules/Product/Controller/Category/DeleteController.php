<?php

namespace App\Modules\Admin\Controller\Product\Category;

use App\Modules\Admin\Logic\Product\ProductCategoryLogic;
use Hyperf\Di\Annotation\Inject;
use YjHyperfAdminPligin\Apidog\Annotations\Api;
use YjHyperfAdminPligin\Apidog\Annotations\ApiParam;
use YjHyperfAdminPligin\Apidog\Annotations\ApiPost;

#[Api("admin/product/category/delete")]
class DeleteController
{
    #[Inject]
    protected ProductCategoryLogic $productCategoryLogic;

    #[ApiPost]
    #[ApiParam("id")]
    public function index(){
        $id = getParams()->get('id');
        $this->productCategoryLogic->delete($id);
        Success();
    }
}