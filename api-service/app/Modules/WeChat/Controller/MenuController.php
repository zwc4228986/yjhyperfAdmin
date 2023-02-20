<?php

namespace App\Modules\WeChat\Controller;

use App\Modules\WeChat\Logic\WechatLogic;
use Hyperf\Di\Annotation\Inject;
use YjHyperfAdminPligin\Apidog\Annotations\Api;
use YjHyperfAdminPligin\Apidog\Annotations\ApiParam;
use YjHyperfAdminPligin\Apidog\Annotations\ApiPost;

#[Api('api/wechat/menu')]
class MenuController
{
    #[Inject]
    private WechatLogic $wechatLogic;

    #[ApiPost('create')]
    #[ApiParam('data')]
    public function create(){
        $params = getParams();
        $data = $this->wechatLogic->menuCreate($params->get('data'));
        Success($data);
    }
    #[ApiPost('get')]
    public function get()
    {
        $data = $this->wechatLogic->menuGet();
        Success($data);
    }
}