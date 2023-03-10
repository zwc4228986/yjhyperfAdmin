<?php

namespace App\Modules\Admin\Controller\Product\Category;

use App\Modules\Admin\Logic\Product\ProductCategoryLogic;
use Hyperf\Di\Annotation\Inject;
use YjHyperfAdminPligin\Apidog\Annotations\Api;
use YjHyperfAdminPligin\Apidog\Annotations\ApiParam;
use YjHyperfAdminPligin\Apidog\Annotations\ApiPost;

#[Api("admin/product/category/edit")]
class EditController
{
    #[Inject]
    protected ProductCategoryLogic $productCategoryLogic;

    #[ApiPost]
    #[ApiParam("id")]
    #[ApiParam("name")]
    #[ApiParam("file_id")]
    #[ApiParam("sort")]
    #[ApiParam("is_show")]
    public function index()
    {
        $params = getParams();
        $this->productCategoryLogic->edit($params->get('id'), $params->except('id'));
        Success();
    }
}