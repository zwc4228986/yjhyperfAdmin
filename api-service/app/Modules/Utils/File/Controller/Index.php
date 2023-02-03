<?php

namespace App\Modules\Utils\File\Controller;

use App\Dao\System\SystemFileDao;
use Hyperf\Di\Annotation\Inject;
use Hyperf\Filesystem\FilesystemFactory;
use Hyperf\HttpMessage\Stream\SwooleStream;
use Hyperf\HttpServer\Contract\RequestInterface;
use Hyperf\HttpServer\Contract\ResponseInterface;
use YjHyperfAdminPligin\Apidog\Annotations\Api;
use YjHyperfAdminPligin\Apidog\Annotations\ApiGet;

#[Api('api/utils/file/{id}')]
class Index
{
    #[Inject]
    protected \App\Modules\Utils\File\Dao\SystemFileDao $systemFileDao;

    #[Inject]
    protected FilesystemFactory $filesystemFactory;

    #[ApiGet]
    public function index(RequestInterface $request,ResponseInterface $response){
        $id = $request->route('id');
        $file = $this->systemFileDao->where('id', $id)->insert();
        $path = $this->filesystemFactory->get('public')->read($file->path);

        return $response
            ->withAddedHeader('content-type', 'image/png')
            ->withBody(new SwooleStream($path));
    }

}