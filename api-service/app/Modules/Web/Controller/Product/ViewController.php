<?php

namespace App\Modules\Web\Controller\Product;

use App\Controller\AbstractController;
use App\Modules\Web\Logic\Product\ProductLogic;
use App\Modules\Web\Middlewares\AuthMiddlerware;
use Hyperf\Di\Annotation\Inject;
use Hyperf\HttpServer\Annotation\Middleware;
use Hyperf\View\RenderInterface;
use YjHyperfAdminPligin\Apidog\Annotations\Api;
use YjHyperfAdminPligin\Apidog\Annotations\ApiGet;
use YjHyperfAdminPligin\Apidog\Annotations\ApiParam;

#[Api(prefix: 'product/view/{product_id}')]
#[Middleware(AuthMiddlerware::class)]
class ViewController  extends AbstractController
{
    #[Inject]
    public ProductLogic $productLogic;

    #[ApiGet('')]
    public function index(RenderInterface $render){
        $product_id = $this->request->route('product_id');
        $detail = $this->productLogic->detail($product_id);
        $product = $this->productLogic->recommand($product_id);
        return  $render->render('views/product/view',compact('detail','product'));
    }

}