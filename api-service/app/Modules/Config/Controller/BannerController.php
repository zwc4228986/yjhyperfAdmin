<?php

namespace App\Modules\Config\Controller;

use App\Modules\Config\Logic\BannerLogic;
use Hyperf\Di\Annotation\Inject;
use YjHyperfAdminPligin\Apidog\Annotations\Api;
use YjHyperfAdminPligin\Apidog\Annotations\ApiPost;

#[Api("api/banner")]
class BannerController
{
    #[Inject]
    protected BannerLogic $bannerLogic;

    #[ApiPost('lists')]
    public function lists(){
        $data = $this->bannerLogic->lists();
        Success($data);
    }
}