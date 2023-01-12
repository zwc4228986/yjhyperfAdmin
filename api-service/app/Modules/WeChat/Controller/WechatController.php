<?php

namespace App\Modules\WeChat\Controller;

use App\Modules\WeChat\Logic\WechatLogic;
use Hyperf\Di\Annotation\Inject;
use YjHyperfAdminPligin\Apidog\Annotations\Api;
use YjHyperfAdminPligin\Apidog\Annotations\ApiGet;
use YjHyperfAdminPligin\Apidog\Annotations\ApiPost;

#[Api('api/wechat')]
class WechatController
{
    #[Inject]
    private WechatLogic $wechatLogic;

    #[ApiGet("")]
    #[ApiPost("")]
    public function index(){
        dump(111);
        return $this->wechatLogic->service();
    }
}