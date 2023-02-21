<?php

namespace App\Modules\Admin\Controller\Circle;


use App\Modules\Admin\Logic\Circle\CircleLogic;
use Hyperf\Di\Annotation\Inject;
use YjHyperfAdminPligin\Apidog\Annotations\Api;
use YjHyperfAdminPligin\Apidog\Annotations\ApiParam;
use YjHyperfAdminPligin\Apidog\Annotations\ApiPost;

#[Api("admin/circle/delete")]
class DeleteController
{
    #[Inject]
    protected CircleLogic $circleLogic;

    #[ApiPost]
    #[ApiParam("id")]
    public function index(){
        $params = getParams();
        $this->circleLogic->del($params->get('id'));
        Success();
    }
}