<?php

namespace App\Modules\Admin\Controller\Menu;

use App\Modules\Admin\Logic\System\MenuLogic;
use Hyperf\Di\Annotation\Inject;
use YjHyperfAdminPligin\Apidog\Annotations\Api;
use YjHyperfAdminPligin\Apidog\Annotations\ApiParam;
use YjHyperfAdminPligin\Apidog\Annotations\ApiPost;

#[Api("admin/menu/edit")]
class EditController
{
    #[Inject]
    protected MenuLogic $menuLogic;

    #[ApiPost]
    #[ApiParam("id")]
    #[ApiParam("title")]
    #[ApiParam("pid")]
    #[ApiParam("type")]
    #[ApiParam("name")]
    #[ApiParam("icon","nullable")]
    #[ApiParam("path")]
    #[ApiParam("hidden")]
    #[ApiParam("position")]
    #[ApiParam("component")]
    public function index(){
        $params = getParams();
        tap($this->menuLogic->edit($params->get('id'), $params->except('id')), function ($data) {
            $data ? Success() : Error();
        });
    }
}