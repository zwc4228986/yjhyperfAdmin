<?php

namespace App\Modules\Web\Controller;

use App\Controller\AbstractController;
use App\Modules\Web\Logic\Product\ProductLogic;
use App\Modules\Web\Middlewares\AuthMiddlerware;
use App\Modules\Web\Middlewares\MustAuthMiddlerware;
use GrahamCampbell\ResultType\Success;
use Hyperf\Di\Annotation\Inject;
use Hyperf\HttpServer\Annotation\Middleware;
use Hyperf\View\RenderInterface;
use YjHyperfAdminPligin\Apidog\Annotations\Api;
use YjHyperfAdminPligin\Apidog\Annotations\ApiGet;
use YjHyperfAdminPligin\Apidog\Annotations\ApiParam;

#[Api(prefix: '')]
#[Middleware(AuthMiddlerware::class)]
class IndexController extends AbstractController
{
    #[Inject]
    protected ProductLogic $productLogic;

    #[ApiGet(path: '/')]
    #[ApiParam('product_category_id', 'nullable')]
    #[ApiParam('product_category_pid', 'nullable')]
    public function index(RenderInterface $render)
    {
        $params = getParams();
        $product = $this->productLogic->lists($params);
        dump(url('test',['id' => 111]));
        return  $render->render('index',compact('product'));
    }
}