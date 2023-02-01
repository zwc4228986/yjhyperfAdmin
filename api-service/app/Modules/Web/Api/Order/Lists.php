<?php

namespace App\Modules\Web\Api\Order;

use App\Modules\Order\Logic\OrderLogic;
use App\Modules\Web\Middlewares\MustAuthMiddlerware;
use Hyperf\Di\Annotation\Inject;
use Hyperf\HttpServer\Annotation\Middleware;
use Hyperf\Utils\Collection;
use YjHyperfAdminPligin\Apidog\Annotations\Api;
use YjHyperfAdminPligin\Apidog\Annotations\ApiPost;
use function App\Modules\Web\Helper\getUserID;

#[Api('web/api/order/lists')]
#[Middleware(MustAuthMiddlerware::class)]
class Lists
{
    #[Inject]
    protected OrderLogic $orderLogic;
    #[ApiPost]
    public function index(){
        $userId = getUserID();
        $data = $this->orderLogic->lists(Collection::make(['user_id' => $userId]));
        Success($data);
    }
}