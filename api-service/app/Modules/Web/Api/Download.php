<?php

namespace App\Modules\Web\Api;

use App\Model\OrderProduct;
use App\Modules\Admin\Dao\ProductResourceDao;
use Hyperf\Di\Annotation\Inject;
use Hyperf\Filesystem\FilesystemFactory;
use Hyperf\HttpServer\Contract\RequestInterface;
use Hyperf\HttpServer\Contract\ResponseInterface;
use YjHyperfAdminPligin\Apidog\Annotations\Api;
use YjHyperfAdminPligin\Apidog\Annotations\ApiGet;
use YjHyperfAdminPligin\Apidog\Annotations\ApiPost;
use function Swoole\Coroutine\Http\request;

#[Api('web/api/download/{order_id}')]
class Download
{

    #[Inject]
    protected RequestInterface $request;

    #[Inject]
    protected ResponseInterface $response;

    #[Inject]
    protected ProductResourceDao $productResourceDao;

    #[Inject]
    protected OrderProduct $orderProduct;

    #[Inject]
    protected FilesystemFactory $filesystemFactory;

    #[ApiGet]
    public function index(){
       $order_id = $this->request->route('order_id');
       //查询商品
       $orderProduct =  $this->orderProduct->where('order_id',$order_id)->first();
       $product_id = $orderProduct->product_id;
       $product =  $this->productResourceDao->where('product_id', $product_id)
           ->where('type',0)
           ->with('File')
           ->first();
       $orderProduct->increment('download');
       dump(config('file.storage.public.root').($product->File->path));
       return $this->response->download(config('file.storage.public.root').($product->File->path));
    }

}