<?php

namespace App\Modules\Admin\Controller\Circle\Category;


use App\Modules\Admin\Logic\Circle\CircleCategoryLogic;
use App\Modules\Admin\Logic\Circle\CircleLogic;
use Hyperf\Di\Annotation\Inject;
use YjHyperfAdminPligin\Apidog\Annotations\Api;
use YjHyperfAdminPligin\Apidog\Annotations\ApiParam;
use YjHyperfAdminPligin\Apidog\Annotations\ApiPost;

#[Api("admin/circle_category/edit")]
class EditController
{
    #[Inject]
    protected CircleCategoryLogic $circleCategoryLogic;

    #[ApiPost]
    #[ApiParam("name")]
    #[ApiParam("id")]
    #[ApiParam("sort")]
    #[ApiParam("is_show")]
    public function  index(){
        $params = getParams();
        $this->circleCategoryLogic->edit($params->get('id'),$params->except('id'));
        Success();
    }
}