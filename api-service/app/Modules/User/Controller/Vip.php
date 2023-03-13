<?php
/**
 * @Notes:【】
 * @Date: 2023-03-11 22:40
 */

namespace App\Modules\User\Controller;

use App\Modules\User\Logic\User\UserVipLogic;
use GrahamCampbell\ResultType\Success;
use Hyperf\Di\Annotation\Inject;
use Hyperf\HttpServer\Annotation\PostMapping;
use YjHyperfAdminPligin\Apidog\Annotations\Api;
use YjHyperfAdminPligin\Apidog\Annotations\ApiPost;

#[Api("api/user/vip")]
class Vip
{
    #[Inject]
    protected UserVipLogic $userVipLogic;

    #[ApiPost('card')]
    public function card()
    {
        $privilege = $this->userVipLogic->privilege();
        Success(compact('privilege'));
    }
}