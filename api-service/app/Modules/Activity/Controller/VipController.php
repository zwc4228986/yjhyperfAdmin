<?php

namespace App\Modules\Activity\Controller;

use App\Modules\Activity\Logic\VipLogic;
use App\Modules\User\Logic\User\UserVipLogic;
use App\Modules\Web\Middlewares\MustAuthMiddlerware;
use Hyperf\Di\Annotation\Inject;
use Hyperf\HttpServer\Annotation\Middleware;
use YjHyperfAdminPligin\Apidog\Annotations\Api;
use YjHyperfAdminPligin\Apidog\Annotations\ApiPost;
use function App\Modules\Web\Helper\getUserID;

/**
 * @Notes:【】
 * @Date: 2023-03-12 16:15
 */
#[Api("api/activity")]
#[Middleware(MustAuthMiddlerware::class)]
class VipController
{
    #[Inject]
    protected VipLogic $vipLogic;

    #[ApiPost('send_vip')]
    public function send()
    {
        $userId = getUserID();
        $this->vipLogic->send($userId, 7);
        Success();
    }
}