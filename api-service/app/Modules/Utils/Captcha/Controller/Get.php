<?php

namespace App\Modules\Utils\Captcha\Controller;

use App\Modules\Utils\Captcha\Logic\CaptchaLogic;
use Hyperf\Config\Annotation\Value;
use Hyperf\Di\Annotation\Inject;
use YjHyperfAdminPligin\Apidog\Annotations\Api;
use YjHyperfAdminPligin\Apidog\Annotations\ApiGet;

#[Api('api/utils/captcha')]
class Get
{

    #[Inject]
    protected CaptchaLogic $captchaLogic;

    #[ApiGet]
    public function index(){
        $data = $this->captchaLogic->build(4);
        return $data;
    }
}