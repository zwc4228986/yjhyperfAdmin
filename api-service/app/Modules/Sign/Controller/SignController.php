<?php
/**
 * @Notes:【】
 * @Date: 2023-02-18 13:48
 */

namespace App\Modules\Sign\Controller;

use App\Modules\Sign\Logic\SignLogic;
use App\Modules\Web\Middlewares\MustAuthMiddlerware;
use GrahamCampbell\ResultType\Success;
use Hyperf\Di\Annotation\Inject;
use Hyperf\HttpServer\Annotation\Middleware;
use YjHyperfAdminPligin\Apidog\Annotations\Api;
use YjHyperfAdminPligin\Apidog\Annotations\ApiPost;
use function App\Modules\Web\Helper\getUserID;

#[Api('api/sign')]
#[Middleware(MustAuthMiddlerware::class)]
class SignController
{
    #[Inject]
    protected SignLogic $signLogic;

    #[ApiPost]
    public function index()
    {
        $userId = getUserID();
        $point = $this->signLogic->sign($userId);
        Success($point);
    }

    #[ApiPost('lists')]
    public function lists()
    {
        $userId = getUserID();
        $data = $this->signLogic->lists();
        $number = $this->signLogic->getSignNumber($userId);
        Success(compact('data', 'number'));
    }
}