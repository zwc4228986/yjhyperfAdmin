<?php

namespace App\Modules\Order\Controller;

use App\Modules\Order\Dao\OrderProductDao;
use App\Modules\Order\Logic\OrderProductLogic;
use Hyperf\Di\Annotation\Inject;
use YjHyperfAdminPligin\Apidog\Annotations\Api;
use YjHyperfAdminPligin\Apidog\Annotations\ApiParam;
use YjHyperfAdminPligin\Apidog\Annotations\ApiPost;

#[Api('api/order/product')]
class Product
{
    
    #[Inject]
    protected OrderProductLogic $orderProductLogic;

    #[ApiPost('download_detail')]
    #[ApiParam('order_product_id')]
    public function download_detail(){
        $order_product_id = getParams()->get('order_product_id');
        $data = $this->orderProductLogic->download_detail($order_product_id);
        Success($data);
    }

}