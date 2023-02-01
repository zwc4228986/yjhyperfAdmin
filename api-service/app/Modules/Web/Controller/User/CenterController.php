<?php

namespace App\Modules\Web\Controller\User;

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

#[Api(prefix: 'user/center')]
#[Middleware(MustAuthMiddlerware::class)]

class CenterController
{
    #[Inject]
    protected OrderLogic $orderLogic;

    #[ApiGet]
    public function index(RenderInterface $render){
        $orderData = $this->orderLogic->lists(Collection::make());
        return $render->render('views/user/center');
    }
}