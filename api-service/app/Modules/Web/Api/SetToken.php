<?php

namespace App\Modules\Web\Api;

use Hyperf\Contract\SessionInterface;
use Hyperf\Di\Annotation\Inject;
use Hyperf\Session\Session;
use YjHyperfAdminPligin\Apidog\Annotations\Api;
use YjHyperfAdminPligin\Apidog\Annotations\ApiParam;
use YjHyperfAdminPligin\Apidog\Annotations\ApiPost;

#[Api('web/api/set_token')]
class SetToken
{
    #[Inject]
    protected SessionInterface $session;

    #[ApiPost]
    #[ApiParam(key: 'token')]
    public function index(){
        dump(getParams());
        $this->session->set('token',getParams()->get('token'));
        return [
            'code'=>200
        ];
    }
}