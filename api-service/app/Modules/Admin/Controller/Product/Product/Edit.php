<?php

namespace App\Modules\Admin\Controller\Product\Product;

use App\Modules\Admin\Logic\Product\ProductLogic;
use Hyperf\Di\Annotation\Inject;
use YjHyperfAdminPligin\Apidog\Annotations\Api;
use YjHyperfAdminPligin\Apidog\Annotations\ApiParam;
use YjHyperfAdminPligin\Apidog\Annotations\ApiPost;

#[Api("admin/product/edit")]
class Edit
{
    #[Inject]
    protected ProductLogic $productLogic;

    #[ApiPost]
    #[ApiParam("id")]
    #[ApiParam("name")]
    #[ApiParam("price")]
    #[ApiParam("types")]
    #[ApiParam("description")]
    #[ApiParam("image_ids")]
    #[ApiParam("status")]
    #[ApiParam("product_category_id")]
    #[ApiParam("resource_id", 'nullable')]
    #[ApiParam("baidu_url", 'nullable')]
    #[ApiParam("baidu_code", 'nullable')]
    public function index()
    {
        $params = getParams();
        $data = $this->productLogic->edit($params->get('id'), $params->except('id'));
        Success($data);
    }
}