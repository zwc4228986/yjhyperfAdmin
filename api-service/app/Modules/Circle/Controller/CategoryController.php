<?php

namespace App\Modules\Circle\Controller;

use App\Modules\Circle\Logic\CircleCategoryLogic;
use Hyperf\Di\Annotation\Inject;
use YjHyperfAdminPligin\Apidog\Annotations\Api;
use YjHyperfAdminPligin\Apidog\Annotations\ApiPost;

#[Api('api/circle_category/lists')]
class CategoryController
{

    #[Inject]
    protected CircleCategoryLogic  $circleCategoryLogic;

    #[ApiPost]
    public function lists(){
        $data = $this->circleCategoryLogic->lists();
        Success($data);
    }
    
}