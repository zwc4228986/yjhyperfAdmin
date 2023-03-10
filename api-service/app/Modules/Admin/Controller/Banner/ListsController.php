<?php
/**
 * @Notes:【】
 * @Date: 2023-03-06 20:59
 */

namespace App\Modules\Admin\Controller\Banner;

use App\Modules\Admin\Logic\Config\BannerLogic;
use Hyperf\Di\Annotation\Inject;
use YjHyperfAdminPligin\Apidog\Annotations\Api;
use YjHyperfAdminPligin\Apidog\Annotations\ApiPost;

#[Api("admin/banner/lists")]
class ListsController
{
    #[Inject]
    protected BannerLogic $bannerLogic;

    #[ApiPost]
    public function index()
    {
        $data = $this->bannerLogic->lists();
        Success($data);
    }
}