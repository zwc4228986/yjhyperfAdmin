<?php
/**
 * @Notes:【】
 * @Date: 2023-02-17 23:26
 */

namespace App\Modules\Sign\Controller;

use App\Modules\Sign\Logic\SignTaskLogic;
use App\Modules\Web\Middlewares\MustAuthMiddlerware;
use Hyperf\Di\Annotation\Inject;
use Hyperf\HttpServer\Annotation\Middleware;
use YjHyperfAdminPligin\Apidog\Annotations\Api;
use YjHyperfAdminPligin\Apidog\Annotations\ApiGet;
use YjHyperfAdminPligin\Apidog\Annotations\ApiPost;
use function App\Modules\Web\Helper\getUserID;

#[Api('api/sign/task')]
#[Middleware(MustAuthMiddlerware::class)]
class SignTaskController
{
    #[Inject]
    protected SignTaskLogic $signTaskLogic;

    #[ApiPost('lists')]
    public function lists()
    {
        $user_id = getUserID();
        $data = $this->signTaskLogic->lists(collect(['status' => 1]), $user_id);
        Success($data);
    }
}