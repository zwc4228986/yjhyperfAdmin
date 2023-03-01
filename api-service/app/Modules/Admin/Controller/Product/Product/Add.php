<?php

namespace App\Modules\Admin\Controller\Product\Product;

use App\Modules\Admin\Logic\Product\ProductLogic;
use Hyperf\Di\Annotation\Inject;
use YjHyperfAdminPligin\Apidog\Annotations\Api;
use YjHyperfAdminPligin\Apidog\Annotations\ApiParam;
use YjHyperfAdminPligin\Apidog\Annotations\ApiPost;

#[Api("admin/product/add")]
class Add
{
    #[Inject]
    protected ProductLogic $productLogic;

    #[ApiPost]
    #[ApiParam("name")]
    #[ApiParam("price")]
    #[ApiParam("types")]
    #[ApiParam("description")]
    #[ApiParam("image_ids")]
    #[ApiParam("status")]
    #[ApiParam("product_category_id")]
    #[ApiParam("resource_id","nullable")]
    #[ApiParam("baidu_resource",'nullable')]
    public function add()
    {
        $params = getParams();
        $data = $this->productLogic->add($params);
        Success($data);
    }
}