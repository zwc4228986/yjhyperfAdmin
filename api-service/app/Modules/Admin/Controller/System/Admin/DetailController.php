<?php
/**
 * @Notes:【】
 * @Date: 2023-01-16 23:29
 */

namespace App\Modules\Admin\Controller\System\Admin;

use App\Modules\Admin\BaseController;
use App\Modules\Admin\Logic\System\AdminLogic;
use App\Modules\Admin\Middlerwares\MustAuthMiddlerware;
use Hyperf\Di\Annotation\Inject;
use Hyperf\HttpServer\Annotation\Middleware;
use YjHyperfAdminPligin\Apidog\Annotations\Api;
use YjHyperfAdminPligin\Apidog\Annotations\ApiPost;


#[Api('admin/system/admin/detail')]
#[Middleware(MustAuthMiddlerware::class)]
class DetailController extends BaseController
{
    #[Inject]
    protected AdminLogic $adminLogic;

    #[ApiPost]
    public function index()
    {
        $adminId = $this->getAdminId();
        $detail = $this->adminLogic->detail($adminId);
        Success($detail);
    }
}