<?php

namespace App\Modules\Circle\Controller;

use App\Modules\Circle\Logic\CircleLogic;
use Hyperf\Di\Annotation\Inject;
use YjHyperfAdminPligin\Apidog\Annotations\Api;
use YjHyperfAdminPligin\Apidog\Annotations\ApiPost;

#[Api('api/circle/lists')]
class ListsController
{
    #[Inject]
    protected CircleLogic $circleLogic;

    #[ApiPost]
    public function lists(){
        $data = $this->circleLogic->lists();
        Success($data);
    }

}