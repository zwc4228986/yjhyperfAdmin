<?php

namespace App\Modules\Web\Api;

use App\Modules\Admin\Dao\ProductResourceDao;
use Hyperf\Di\Annotation\Inject;
use Hyperf\Filesystem\FilesystemFactory;
use Hyperf\HttpServer\Contract\RequestInterface;
use Hyperf\HttpServer\Contract\ResponseInterface;
use YjHyperfAdminPligin\Apidog\Annotations\Api;
use YjHyperfAdminPligin\Apidog\Annotations\ApiGet;
use YjHyperfAdminPligin\Apidog\Annotations\ApiPost;
use function Swoole\Coroutine\Http\request;

#[Api('web/api/download/{product_id}')]
class Download
{

    #[Inject]
    protected RequestInterface $request;

    #[Inject]
    protected ResponseInterface $response;

    #[Inject]
    protected ProductResourceDao $productResourceDao;

    #[Inject]
    protected FilesystemFactory $filesystemFactory;
    
    #[ApiGet]
    public function index(){
       $product_id = $this->request->route('product_id');
      $product =  $this->productResourceDao->where('product_id', $product_id)
           ->where('type',0)
           ->with('File')
           ->first();
       return $this->response->download($this->filesystemFactory->get('public')->getPrefixPath($product->File->path));
    }
}