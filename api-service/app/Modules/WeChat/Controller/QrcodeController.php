<?php

namespace App\Modules\WeChat\Controller;

use App\Modules\WeChat\Logic\WechatLogic;
use Hyperf\Di\Annotation\Inject;
use YjHyperfAdminPligin\Apidog\Annotations\Api;
use YjHyperfAdminPligin\Apidog\Annotations\ApiPost;

#[Api('api/wechat/qrcode')]
class QrcodeController
{
    #[Inject]
    private WechatLogic $wechatLogic;

    #[ApiPost("")]
    public function index(){
        return $this->wechatLogic->qrcode();
    }
}