<?php

namespace App\Modules\Admin\Controller\Circle\Category;


use App\Modules\Admin\Logic\Circle\CircleCategoryLogic;
use App\Modules\Admin\Logic\Circle\CircleLogic;
use Hyperf\Di\Annotation\Inject;
use YjHyperfAdminPligin\Apidog\Annotations\Api;
use YjHyperfAdminPligin\Apidog\Annotations\ApiParam;
use YjHyperfAdminPligin\Apidog\Annotations\ApiPost;

#[Api("admin/circle_category/delete")]
class DeleteController
{
    #[Inject]
    protected CircleCategoryLogic $circleCategoryLogic;

    #[ApiPost]
    #[ApiParam("id")]
    public function index(){
        $params = getParams();
        $this->circleCategoryLogic->del($params->get('id'));
        Success();
    }
}