<?php

namespace App\Modules\WeChat\Controller;

use App\Modules\WeChat\Logic\WechatLogic;
use Hyperf\Di\Annotation\Inject;
use YjHyperfAdminPligin\Apidog\Annotations\Api;
use YjHyperfAdminPligin\Apidog\Annotations\ApiGet;
use YjHyperfAdminPligin\Apidog\Annotations\ApiParam;
use YjHyperfAdminPligin\Apidog\Annotations\ApiPost;

#[Api('api/wechat/userinfo')]
class UserInfoController
{

    #[Inject]
    private WechatLogic $wechatLogic;

    #[ApiGet]
    #[ApiPost]
    #[ApiParam(key: 'openid')]
    public function index(){
        //o9xuL51nT0nrHApHvVG8rG3OTzag
        $params = getParams();
        return $this->wechatLogic->getUserInfo($params->get('openid'));
    }
}