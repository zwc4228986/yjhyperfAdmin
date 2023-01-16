<?php

namespace App\Modules\Admin\Controller\Menu;

use App\Modules\Admin\BaseController;
use App\Modules\Admin\Logic\System\MenuLogic;
use App\Modules\Admin\Middlerwares\MustAuthMiddlerware;
use Hyperf\Di\Annotation\Inject;
use Hyperf\HttpServer\Annotation\Middleware;
use YjHyperfAdminPligin\Apidog\Annotations\Api;
use YjHyperfAdminPligin\Apidog\Annotations\ApiPost;

#[Api('admin/menu/auth')]
#[Middleware(MustAuthMiddlerware::class)]
class AuthController extends BaseController
{
    #[Inject]
    protected MenuLogic $menuLogic;

    #[ApiPost]
    public function index(){
        $adminId = $this->getAdminId();
        $data = $this->menuLogic->getListsByAdminId($adminId);
        Success($data);
    }
}