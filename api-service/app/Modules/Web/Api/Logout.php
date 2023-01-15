<?php
/**
 * @Notes:【】
 * @Date: 2023-01-14 1:26
 */

namespace App\Modules\Web\Api;

use App\Modules\Web\Middlewares\MustAuthMiddlerware;
use Hyperf\Contract\SessionInterface;
use Hyperf\Di\Annotation\Inject;
use Hyperf\HttpServer\Annotation\Middleware;
use YjHyperfAdminPligin\Apidog\Annotations\Api;
use YjHyperfAdminPligin\Apidog\Annotations\ApiPost;
use function App\Modules\Web\Helper\getUserID;

#[Api('web/api/logout')]
#[Middleware(MustAuthMiddlerware::class)]
class Logout
{
    #[Inject]
    protected SessionInterface $session;
    #[ApiPost]
    public function index(){
        $this->session->remove('token');
        return [
            'code'=>200
        ];
    }
}