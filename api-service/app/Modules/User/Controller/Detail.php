<?php
/**
 * @Notes:【】
 * @Date: 2023-02-07 23:59
 */

namespace App\Modules\User\Controller;

use App\Modules\User\Logic\User\UserLogic;
use App\Modules\Web\Middlewares\MustAuthMiddlerware;
use GrahamCampbell\ResultType\Success;
use Hyperf\Di\Annotation\Inject;
use Hyperf\HttpServer\Annotation\Middleware;
use YjHyperfAdminPligin\Apidog\Annotations\Api;
use YjHyperfAdminPligin\Apidog\Annotations\ApiGet;
use YjHyperfAdminPligin\Apidog\Annotations\ApiPost;
use function App\Modules\Web\Helper\getUserID;

#[Api('api/user/detail')]
#[Middleware(MustAuthMiddlerware::class)]
class Detail
{
    #[Inject]
    protected UserLogic $userLogic;

    #[ApiGet]
    #[ApiPost]
    public function index()
    {
        $userId = getUserID();
        $data = $this->userLogic->detail($userId);
        Success($data);
    }
}