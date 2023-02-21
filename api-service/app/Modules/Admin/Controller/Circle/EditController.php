<?php

namespace App\Modules\Admin\Controller\Circle;


use App\Modules\Admin\Logic\Circle\CircleLogic;
use Hyperf\Di\Annotation\Inject;
use YjHyperfAdminPligin\Apidog\Annotations\Api;
use YjHyperfAdminPligin\Apidog\Annotations\ApiParam;
use YjHyperfAdminPligin\Apidog\Annotations\ApiPost;

#[Api("admin/circle/edit")]
class EditController
{
    #[Inject]
    protected CircleLogic $circleLogic;

    #[ApiPost]
    #[ApiParam("name")]
    #[ApiParam("id")]
    #[ApiParam("file_id")]
    #[ApiParam("sort")]
    #[ApiParam("is_show")]
    public function  index(){
        $params = getParams();
        $this->circleLogic->edit($params->get('id'),$params->except('id'));
        Success();
    }
}