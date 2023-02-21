<?php

namespace App\Modules\Admin\Controller\Circle;


use App\Modules\Admin\Logic\Circle\CircleLogic;
use Hyperf\Di\Annotation\Inject;
use YjHyperfAdminPligin\Apidog\Annotations\Api;
use YjHyperfAdminPligin\Apidog\Annotations\ApiParam;
use YjHyperfAdminPligin\Apidog\Annotations\ApiPost;

#[Api("admin/circle/add")]
class AddController
{
    #[Inject]
    protected CircleLogic $circleLogic;

    #[ApiPost]
    #[ApiParam("name")]
    #[ApiParam("file_id")]
    #[ApiParam("sort")]
    #[ApiParam("is_show")]
    public function  index(){
        $params = getParams();
        $this->circleLogic->add($params);
        Success();
    }
}