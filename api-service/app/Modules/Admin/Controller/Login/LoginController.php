<?php
/**
 * @Notes:【】
 * @Date: 2023-01-14 20:44
 */

namespace App\Modules\Admin\Controller\Login;

use App\Modules\Admin\Logic\LoginLogic;
use GrahamCampbell\ResultType\Success;
use Hyperf\Di\Annotation\Inject;
use YjHyperfAdminPligin\Apidog\Annotations\Api;
use YjHyperfAdminPligin\Apidog\Annotations\ApiParam;
use YjHyperfAdminPligin\Apidog\Annotations\ApiPost;

#[Api('admin/login')]
class LoginController
{

    #[Inject]
    protected LoginLogic $loginLogic;

    #[ApiPost]
    #[ApiParam('username')]
    #[ApiParam('password')]
    public function index(){
        $params = getParams();
        $data = $this->loginLogic->login($params->get('username'),$params->get('password'));
        Success($data);
    }
}