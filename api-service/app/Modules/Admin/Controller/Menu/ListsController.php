<?php

namespace App\Modules\Admin\Controller\Menu;

use App\Modules\Admin\Logic\System\MenuLogic;
use Hyperf\Di\Annotation\Inject;
use YjHyperfAdminPligin\Apidog\Annotations\Api;
use YjHyperfAdminPligin\Apidog\Annotations\ApiPost;

#[Api("admin/menu/lists")]
class ListsController
{
    #[Inject]
    protected MenuLogic $menuLogic;

    #[ApiPost]
    public function index(){
        $data = $this->menuLogic->lists();
        Success(Tree($data));
    }
}