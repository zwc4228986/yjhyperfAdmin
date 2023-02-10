<?php
/**
 * @Notes:【】
 * @Date: 2023-02-09 22:57
 */

namespace App\Modules\WeChat\Controller\Miniapp;

use App\Modules\User\Logic\User\UserLogic;
use App\Modules\WeChat\Logic\MiniAppLogic;
use GrahamCampbell\ResultType\Success;
use Hyperf\Di\Annotation\Inject;
use YjHyperfAdminPligin\Apidog\Annotations\Api;
use YjHyperfAdminPligin\Apidog\Annotations\ApiParam;
use YjHyperfAdminPligin\Apidog\Annotations\ApiPost;

#[Api('api/wechat/miniapp/code2session')]
class Code2Session
{
    #[Inject]
    protected MiniAppLogic $miniAppLogic;

    #[Inject]
    protected \App\Modules\User\Logic\Login\MiniappLogic $miniappLogicLogic;

    #[Inject]
    protected UserLogic $userLogic;

    #[ApiPost]
    #[ApiParam("code")]
    public function index()
    {
        $params = getParams();

        $data = $this->miniAppLogic->code2Session($params->get('code'));

        $data = $this->miniappLogicLogic->miniapp($data['openid'], $data['unionid']);
        $data['userData'] = $this->userLogic->detail($data['user_id']);


        Success($data);
    }
}