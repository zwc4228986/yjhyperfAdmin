<?php
/**
 * @Notes:【】
 * @Date: 2023-02-26 17:37
 */

namespace App\Modules\User\Controller;

use App\Modules\User\Logic\User\UserCircleLogic;
use App\Modules\Web\Middlewares\MustAuthMiddlerware;
use GrahamCampbell\ResultType\Success;
use Hyperf\Di\Annotation\Inject;
use Hyperf\HttpServer\Annotation\Middleware;
use YjHyperfAdminPligin\Apidog\Annotations\Api;
use YjHyperfAdminPligin\Apidog\Annotations\ApiPost;
use function App\Modules\Web\Helper\getUserID;

#[Api("api/user/collect")]
#[Middleware(MustAuthMiddlerware::class)]
class Collect
{
    #[Inject]
    protected UserCircleLogic $userCircleLogic;

    #[ApiPost]
    public function index()
    {
        $user_id = getUserID();
        $data = $this->userCircleLogic->lists($user_id);
        Success($data);
    }

}