<?php

namespace App\Modules\Circle\Controller;

use App\Modules\Circle\Logic\CircleCategoryLogic;
use App\Modules\Circle\Model\CircleCategoryModel;
use Hyperf\Di\Annotation\Inject;
use YjHyperfAdminPligin\Apidog\Annotations\Api;
use YjHyperfAdminPligin\Apidog\Annotations\ApiPost;

#[Api('api/circle_category')]
class CategoryController
{

    #[Inject]
    protected CircleCategoryLogic  $circleCategoryLogic;

    #[ApiPost("lists")]
    public function lists(){
        $data = $this->circleCategoryLogic->lists();
        Success($data);
    }

    #[ApiPost("tree")]
    public function tree(){

        $data = $this->circleCategoryLogic->tree();

        Success($data);
    }

}