<?php

namespace App\Modules\Nav\Controller;

use App\Modules\Nav\Logic\NavLogic;
use Hyperf\Di\Annotation\Inject;
use YjHyperfAdminPligin\Apidog\Annotations\Api;
use YjHyperfAdminPligin\Apidog\Annotations\ApiParam;
use YjHyperfAdminPligin\Apidog\Annotations\ApiPost;

#[Api("api/nav/lists")]
class ListsController
{
    #[Inject]
    protected NavLogic $navLogic;

    #[ApiPost]
    #[ApiParam("circle_id",'nullable')]
    public function index(){
        $params = getParams();
        $data = $this->navLogic->lists($params);
        Success($data);
    }
    
}