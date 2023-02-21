<?php

namespace App\Modules\Admin\Controller\Circle\Category;

use App\Modules\Admin\Logic\Circle\CircleCategoryLogic;
use Hyperf\Di\Annotation\Inject;
use YjHyperfAdminPligin\Apidog\Annotations\Api;
use YjHyperfAdminPligin\Apidog\Annotations\ApiPost;

#[Api("admin/circle_category/lists")]
class Lists
{
    #[Inject]
    protected CircleCategoryLogic $circleCategoryLogic;

    #[ApiPost]
    public function index(){
        $data = $this->circleCategoryLogic->lists();
        Success($data);
    }
}