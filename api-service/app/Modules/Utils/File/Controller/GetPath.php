<?php

namespace App\Modules\Utils\File\Controller;

use App\Modules\Utils\File\Dao\SystemFileDao;
use Hyperf\Di\Annotation\Inject;
use YjHyperfAdminPligin\Apidog\Annotations\Api;
use YjHyperfAdminPligin\Apidog\Annotations\ApiParam;
use YjHyperfAdminPligin\Apidog\Annotations\ApiPost;

#[Api('api/utils/file/get-path')]
class GetPath
{
    #[Inject]
    protected SystemFileDao $systemFileDao;

    #[ApiPost]
    #[ApiParam("id")]
    public function index(){
        $id = getParams()->get('id');
        $path = getFileFullPath($id)->first();
        Success($path);
    }

}