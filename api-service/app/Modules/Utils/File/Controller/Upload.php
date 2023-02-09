<?php

namespace App\Modules\Utils\File\Controller;

use App\Modules\Utils\File\Dao\SystemFileDao;
use Hyperf\Di\Annotation\Inject;
use Hyperf\Filesystem\FilesystemFactory;
use Hyperf\HttpMessage\Upload\UploadedFile;
use League\Flysystem\Filesystem;
use YjHyperfAdminPligin\Apidog\Annotations\Api;
use YjHyperfAdminPligin\Apidog\Annotations\ApiParam;
use YjHyperfAdminPligin\Apidog\Annotations\ApiPost;
use Hyperf\HttpServer\Contract\ResponseInterface;

#[Api('api/utils/file/upload')]
class Upload
{
    #[Inject]
    protected FilesystemFactory $filesystem;

    #[Inject]
    protected SystemFileDao $systemFileDao;

    #[Inject]
    protected ResponseInterface $response;

    #[ApiPost]
    #[ApiParam('file','file')]
    #[ApiParam('type','nullable')]
    public function upload(){
        $params = getParams();

        /** @var UploadedFile $file */
        $file = $params->get('file');
        $stream = fopen($file->getRealPath(), 'r+');

        $filePath = $this->getFilePath('img', $file->getExtension());

        $this->filesystem->get('qiniu')->writeStream($filePath, $stream);

        $file = $this->systemFileDao->create(['storage'=>'qiniu','name' => $file->getClientFilename(),'type'=>'', 'path' => $filePath, 'size' => $file->getSize(),'suffix'=>$file->getExtension()]);

        fclose($stream);

        if ($params->get('type','default') == 'tinymce') {
            return $this->response->json(['location' => env('WEBSITE_FILE_URL') . $filePath]);
        } else {
            Success(['id' => $file->id, 'path' => $filePath, 'src' =>  env('WEBSITE_FILE_URL').$filePath]);

        }
    }

//    #[ApiPost]
//    #[ApiParam('file','file')]
//    #[ApiParam('type','nullable')]
    public function index(){
        $params = getParams();

        /** @var UploadedFile $file */
        $file = $params->get('file');
        $stream = fopen($file->getRealPath(), 'r+');

        $filePath = $this->getFilePath('img', $file->getExtension());

//        $file->moveTo(($filePath));
//        if (!$file->isMoved()) {
//           Error('move failed');
//        }
        $this->filesystem->get('public')->writeStream($filePath, $stream);
//            Error('writeStream is wrong');
//        }

        //插入数据库
        $file = $this->systemFileDao->create(['name' => $file->getClientFilename(), 'path' => $filePath, 'size' => $file->getSize(),'suffix'=>$file->getExtension()]);
        fclose($stream);

        if ($params->get('type','default') == 'tinymce') {
            return $this->response->json(['location' => env('WEBSITE_FILE_URL') . $filePath]);
        } else {
            Success(['id' => $file->id, 'path' => $filePath, 'src' =>  env('WEBSITE_FILE_URL').$filePath]);

        }
    }

    public function getFilePath($type = 'img', $ext = '')
    {
        $path = '/update/' . $type . '/' . date('ymd') . '/' . time() . rand(1000, 9999) . '.' . $ext;
        return $path;
    }
}