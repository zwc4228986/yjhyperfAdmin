<?php

namespace App\Modules\Web\Controller;

use App\Controller\AbstractController;
use App\Modules\Web\Middlewares\AuthMiddlerware;
use App\Modules\Web\Middlewares\MustAuthMiddlerware;
use Hyperf\HttpServer\Annotation\Middleware;
use Hyperf\View\RenderInterface;
use YjHyperfAdminPligin\Apidog\Annotations\Api;
use YjHyperfAdminPligin\Apidog\Annotations\ApiGet;

#[Api(prefix: '')]
#[Middleware(AuthMiddlerware::class)]
class IndexController extends AbstractController
{
    #[ApiGet(path: '/')]
    public function index(RenderInterface $render)
    {

        return  $render->render('index');
    }
}