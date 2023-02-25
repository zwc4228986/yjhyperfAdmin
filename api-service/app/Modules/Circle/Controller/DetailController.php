<?php

namespace App\Modules\Circle\Controller;

use App\Modules\Circle\Logic\CircleLogic;
use App\Modules\Web\Middlewares\MustAuthMiddlerware;
use Hyperf\Di\Annotation\Inject;
use Hyperf\HttpServer\Annotation\Middleware;
use YjHyperfAdminPligin\Apidog\Annotations\Api;
use YjHyperfAdminPligin\Apidog\Annotations\ApiParam;
use YjHyperfAdminPligin\Apidog\Annotations\ApiPost;
use function App\Modules\Web\Helper\getUserID;

#[Api('api/circle/detail')]
#[Middleware(MustAuthMiddlerware::class)]
class DetailController
{
    #[Inject]
    protected CircleLogic $circleLogic;

    #[ApiPost]
    #[ApiParam('id')]
    public function index()
    {
        $id = getParams()->get('id');
        $userId = getUserID();
        $data = $this->circleLogic->detail($id, $userId);
        Success($data);
    }

}