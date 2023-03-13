<?php
/**
 * @Notes:【】
 * @Date: 2023-03-12 21:28
 */

namespace App\Modules\User\Controller;

use App\Modules\Web\Middlewares\MustAuthMiddlerware;
use Hyperf\HttpServer\Annotation\Middleware;
use YjHyperfAdminPligin\Apidog\Annotations\Api;
use YjHyperfAdminPligin\Apidog\Annotations\ApiPost;
use function App\Modules\Web\Helper\getUserID;

#[Api("api/user/invite")]
#[Middleware(MustAuthMiddlerware::class)]
class Invite
{
    #[ApiPost("detail")]
    public function detail()
    {
        $userId = getUserID();

    }
}