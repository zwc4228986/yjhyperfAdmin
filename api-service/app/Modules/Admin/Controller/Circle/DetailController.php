<?php

namespace App\Modules\Admin\Controller\Circle;


use App\Modules\Admin\Logic\Circle\CircleLogic;
use Hyperf\Di\Annotation\Inject;
use YjHyperfAdminPligin\Apidog\Annotations\Api;
use YjHyperfAdminPligin\Apidog\Annotations\ApiParam;
use YjHyperfAdminPligin\Apidog\Annotations\ApiPost;

#[Api("admin/circle/detail")]
class DetailController
{
    #[Inject]
    protected CircleLogic $circleLogic;

    #[ApiPost]
    public function index()
    {
        $params = getParams();
        $this->circleLogic->add($params);
        Success();
    }
}