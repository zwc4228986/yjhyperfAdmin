<?php

namespace App\Modules\Web\Controller\User;

use App\Controller\AbstractController;
use App\Modules\Order\Logic\OrderLogic;
use App\Modules\Web\Middlewares\AuthMiddlerware;
use App\Modules\Web\Middlewares\MustAuthMiddlerware;
use Hyperf\Di\Annotation\Inject;
use Hyperf\HttpServer\Annotation\Middleware;
use Hyperf\Utils\Collection;
use Hyperf\View\RenderInterface;
use YjHyperfAdminPligin\Apidog\Annotations\Api;
use YjHyperfAdminPligin\Apidog\Annotations\ApiGet;
use YjHyperfAdminPligin\Apidog\Annotations\ApiPost;

#[Api(prefix: 'user/center/{type}')]
#[Middleware(MustAuthMiddlerware::class)]
class CenterController extends AbstractController
{
    #[Inject]
    protected OrderLogic $orderLogic;

    #[ApiGet]
    public function index(RenderInterface $render)
    {
//        $this->orderLogic->lists();
        $type = $this->request->route('type');

        $order = $this->orderLogic->lists(Collection::make());
        return $render->render('views/user/center', compact('order','type'));
    }
}