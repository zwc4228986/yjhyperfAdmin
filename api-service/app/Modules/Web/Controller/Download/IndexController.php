<?php

namespace App\Modules\Web\Controller\Download;

use App\Model\OrderProduct;
use App\Modules\Admin\Dao\ProductResourceDao;
use Hyperf\Di\Annotation\Inject;
use Hyperf\HttpServer\Contract\RequestInterface;
use Hyperf\HttpServer\Contract\ResponseInterface;
use Hyperf\View\RenderInterface;
use YjHyperfAdminPligin\Apidog\Annotations\Api;
use YjHyperfAdminPligin\Apidog\Annotations\ApiGet;

#[Api(prefix: 'download/{order_product_id}')]
class IndexController
{
    #[Inject]
    protected RequestInterface $request;

    #[Inject]
    protected ResponseInterface $response;

    #[Inject]
    protected ProductResourceDao $productResourceDao;

    #[Inject]
    protected OrderProduct $orderProduct;

    #[ApiGet]
    public function index(RenderInterface $render){
        $order_product_id = $this->request->route('order_product_id');
        //查询商品
        $orderProduct =  $this->orderProduct->where('id',$order_product_id)->first();
        $product_id = $orderProduct->product_id;
        $productResource =  $this->productResourceDao->where('product_id', $product_id)
            ->where('type',0)
            ->with(['File','Product'=>function($query){
                $query->with('Image');
            }])
            ->first();
        return  $render->render('views/download/index',compact('productResource'));
    }
}