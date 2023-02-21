<?php

namespace App\Modules\Admin\Controller\Circle;

use App\Modules\Admin\Logic\Circle\CircleLogic;
use Hyperf\Di\Annotation\Inject;
use YjHyperfAdminPligin\Apidog\Annotations\Api;
use YjHyperfAdminPligin\Apidog\Annotations\ApiPost;

#[Api("admin/circle/lists")]
class Lists
{
    #[Inject]
    protected CircleLogic $circleLogic;

    #[ApiPost]
    public function index(){
        $data = $this->circleLogic->lists();
        Success($data);
    }
}