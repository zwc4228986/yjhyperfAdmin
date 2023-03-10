<?php
/**
 * @Notes:【】
 * @Date: 2023-03-06 21:25
 */

namespace App\Modules\Admin\Controller\Banner;


use App\Modules\Admin\Logic\Config\BannerLogic;
use Hyperf\Di\Annotation\Inject;
use YjHyperfAdminPligin\Apidog\Annotations\Api;
use YjHyperfAdminPligin\Apidog\Annotations\ApiParam;
use YjHyperfAdminPligin\Apidog\Annotations\ApiPost;

#[Api("admin/banner/add")]
class AddController
{
    #[Inject]
    protected BannerLogic $bannerLogic;

    #[ApiPost]
    #[ApiParam("image_id")]
    #[ApiParam("is_show")]
    #[ApiParam("link")]
    #[ApiParam("sort")]
    #[ApiParam("title")]
    public function index()
    {
        $params = getParams();
        $data = $this->bannerLogic->add($params);
        Success($data);
    }

}