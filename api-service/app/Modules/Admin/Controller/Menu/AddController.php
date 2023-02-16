<?php

namespace App\Modules\Admin\Controller\Menu;

use App\Modules\Admin\Logic\System\MenuLogic;
use Hyperf\Di\Annotation\Inject;
use YjHyperfAdminPligin\Apidog\Annotations\Api;
use YjHyperfAdminPligin\Apidog\Annotations\ApiParam;
use YjHyperfAdminPligin\Apidog\Annotations\ApiPost;

#[Api("admin/menu/add")]
class AddController
{
    #[Inject]
    protected MenuLogic $menuLogic;

    #[ApiPost]
    #[ApiParam("title")]
    #[ApiParam("pid")]
    #[ApiParam("type")]
    #[ApiParam("name")]
    #[ApiParam("icon","nullable")]
    #[ApiParam("component","nullable")]
    public function index(){
        $params = getParams();
        tap($this->menuLogic->add($params), function ($data) {
            $data ? Success() : Error();
        });
    }
}