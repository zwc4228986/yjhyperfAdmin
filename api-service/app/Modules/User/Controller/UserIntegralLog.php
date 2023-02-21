<?php
/**
 * @Notes:【】
 * @Date: 2023-02-20 22:11
 */

namespace App\Modules\User\Controller;

use App\Modules\User\Logic\User\UserIntegralLogLogic;
use Hyperf\Di\Annotation\Inject;
use YjHyperfAdminPligin\Apidog\Annotations\Api;
use YjHyperfAdminPligin\Apidog\Annotations\ApiPost;

#[Api('api/user/user_integral_log')]
class UserIntegralLog
{
    #[Inject]
    protected UserIntegralLogLogic $userIntegralLogLogic;

    #[ApiPost('lists')]
    public function lists()
    {
        $data = $this->userIntegralLogLogic->lists();
        Success($data);
    }
}