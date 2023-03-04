<?php
/**
 * @Notes:【】
 * @Date: 2023-03-04 16:54
 */

namespace App\Modules\Config\Controller;

use GrahamCampbell\ResultType\Success;
use YjHyperfAdminPligin\Apidog\Annotations\Api;
use YjHyperfAdminPligin\Apidog\Annotations\ApiPost;

#[Api("api/config/share")]
class ShareControoler
{
    #[ApiPost("home")]
    public function home()
    {
        $config = [
            'title' => '全场资源免费',
            'img' => ''
        ];
        Success($config);
    }
}