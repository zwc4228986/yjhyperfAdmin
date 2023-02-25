<?php
/**
 * @Notes:【】
 * @Date: 2023-02-24 22:11
 */

namespace App\Modules\Circle\Controller;

use App\Modules\Circle\Logic\CircleCollectLogic;
use App\Modules\Circle\Logic\CircleLogic;
use App\Modules\Web\Middlewares\MustAuthMiddlerware;
use Hyperf\Di\Annotation\Inject;
use Hyperf\HttpServer\Annotation\Middleware;
use YjHyperfAdminPligin\Apidog\Annotations\Api;
use YjHyperfAdminPligin\Apidog\Annotations\ApiParam;
use YjHyperfAdminPligin\Apidog\Annotations\ApiPost;
use function App\Modules\Web\Helper\getUserID;

#[Api('api/circle/collect')]
#[Middleware(MustAuthMiddlerware::class)]
class CollectController
{
    #[Inject]
    protected CircleCollectLogic $circleCollectLogic;

    #[ApiPost]
    #[ApiParam('circle_id')]
    public function index()
    {
        $params = getParams();
        $userId = getUserID();
        $this->circleCollectLogic->collect($params->get('circle_id'), $userId);
        Success();
    }
}