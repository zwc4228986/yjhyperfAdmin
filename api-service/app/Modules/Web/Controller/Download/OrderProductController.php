<?php

namespace App\Modules\Web\Controller\Download;

use App\Model\OrderProduct;
use App\Modules\Admin\Dao\ProductResourceDao;
use Hyperf\Di\Annotation\Inject;
use Hyperf\Filesystem\FilesystemFactory;
use Hyperf\HttpServer\Contract\RequestInterface;
use Hyperf\HttpServer\Contract\ResponseInterface;
use YjHyperfAdminPligin\Apidog\Annotations\Api;
use YjHyperfAdminPligin\Apidog\Annotations\ApiGet;

#[Api(prefix: 'download/order_product/{order_product_id}')]
class OrderProductController
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
    public function index()
    {
        $order_product_id = $this->request->route('order_product_id');
        //查询商品
        $orderProduct = $this->orderProduct->where('id', $order_product_id)->with(['Product' => function ($query) {
            $query->with(['ProductResource']);
        }])->first();
        dump($orderProduct);
        $file_id = $orderProduct->Product->ProductResource->file_id;
//        $product =  $this->productResourceDao->where('product_id', $product_id)
//            ->where('type',0)
//            ->with('File')
//            ->first();
//       $orderProduct->increment('download');
        dump(getFilePath($file_id));

//       dump(config('file.storage.public.root').($product->File->path));
        $url = $this->filesystemFactory->get('qiniu_file')->getAdapter()->privateDownloadUrl(getFilePath($file_id)->first());
        
        dump($url);
        return $this->response->redirect($url);
    }
}