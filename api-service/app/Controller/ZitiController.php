<?php

namespace App\Controller;

use Hyperf\Di\Annotation\Inject;
use Hyperf\Filesystem\FilesystemFactory;
use League\Flysystem\FileAttributes;
use YjHyperfAdminPligin\Apidog\Annotations\Api;
use YjHyperfAdminPligin\Apidog\Annotations\ApiPost;

#[Api('Ziti')]
class ZitiController
{
    #[Inject]
    protected FilesystemFactory $filesystemFactory;

    #[ApiPost]
    public function index(){
        $filesystemFactory = $this->filesystemFactory->get('ziti');

        collect(['fonts','fonts-image'])->every(function($type)use ($filesystemFactory){
            $fonts = $filesystemFactory->listContents($type);

            /** @var FileAttributes $font */
            foreach ($fonts as $font){

                //获取字体名称
                $this->op($filesystemFactory,$font->path(),$type);

                //拷贝文件
            }
            return true;
        });
        return 'success';
    }

    public function op($filesystemFactory,$path,$type){

        $filename = pathinfo($path, PATHINFO_FILENAME);

        if($type == 'fonts-image'){
            $dirname = explode('-',$filename)[0];
        }else{
            $dirname = $filename;
        }


        //批量生成目录
        $filesystemFactory->createDirectory("new-fonts/{$dirname}");
        dump($filesystemFactory->getAdapter()->getPrefixer()->prefixPath($path),
            $filesystemFactory->getAdapter()->getPrefixer()->prefixPath("new-fonts/{$dirname}/".basename($path)));
        copy(
            $filesystemFactory->getAdapter()->getPrefixer()->prefixPath($path),
            $filesystemFactory->getAdapter()->getPrefixer()->prefixPath("new-fonts/{$dirname}/".basename($path))
        );
    }
}