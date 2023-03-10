<?php

namespace App\Modules\Product\Logic;

use App\Context\Context;
use App\Model\Product;
use App\Model\ProductCategory;
use App\Model\ProductResource;
use App\Modules\Admin\Dao\ProductCategoryDao;
use App\Modules\Admin\Dao\ProductCategoryRelDao;


use App\Modules\Admin\Dao\ProductDescriptionDao;
use App\Modules\Admin\Dao\ProductResourceDao;

use App\Modules\Product\Dao\ProductDao;
use Hyperf\DbConnection\Db;
use Hyperf\Di\Annotation\Inject;
use Hyperf\Utils\Collection;

class ProductLogic
{
    #[Inject]
    protected ProductDao $productDao;

    #[Inject]
    protected ProductDescriptionDao $productDescriptionDao;

    #[Inject]
    protected ProductCategoryRelDao $productCategoryRelDao;

    #[Inject]
    protected ProductCategoryDao $productCategoryDao;

    #[Inject]
    protected ProductResourceDao $productResourceDao;

    public function lists(Collection $params,$userId=0)
    {
        $userInfo = Context::userInfo();
        $vipStatus = $userInfo->getVipStatus();
        $data =  $this->productDao->newSelf()->params($params)->daoWith('Image')->orderByDesc("id")->getList();


        $data->transaction(function($item)use ($vipStatus){
            if($vipStatus){
                $item->old_price = $item->price;
                $item->price = 0;
            }
            return $item;
        });

        return $data;
    }

    public function add(\Hyperf\Utils\Collection $params)
    {
        Db::beginTransaction();
        try {
            $params->offsetSet('image_id', (int)$params->get('image_ids'));
            $product = $this->productDao->create($params->toArray());
            $this->productDescriptionDao->updateOrCreate([
                'product_id' => $product->id,
            ], $params->only(['description'])->toArray());
            $product_category_ids = $params->get('product_category_id');

            $this->updateProductCategoryRel($product->id, $product_category_ids);
            $resource_id = $params->get('resource_id');
            $baidu_resource = $params->get('baidu_resource');
            $this->updateProductResource($product->id, $resource_id, 0);
            $this->updateProductResource($product->id, $baidu_resource, 1);
            Db::commit();
        } catch (\Exception $exception) {
            Db::rollBack();
            Error($exception->getMessage());
        }
        return $product;
    }

    private function updateProductCategoryRel($product_id, $product_category_ids)
    {
        //?????????
        foreach ($product_category_ids as $product_category_id) {
            //??????????????????
            $product_category_pid = $this->productCategoryDao->newSelf()->where('id', $product_category_id)->value('pid');

            $this->productCategoryRelDao->updateOrCreate([
                'product_category_pid' => $product_category_pid,
                'product_category_id' => $product_category_id,
                'product_id' => $product_id
            ]);
        }
    }

    private function updateProductResource(int $product_id, $resource, int $type)
    {
        if (!$resource) {
            $this->productResourceDao->where('product_id', $product_id)
                ->where('type', $type)->delete();
        }
        if ($type == 0) {
            $this->productResourceDao->updateOrCreate([
                'product_id' => $product_id,
                'type' => $type,
            ], [
                'file_id' => $resource
            ]);
        }

        if ($type == 1) {
            $this->productResourceDao->updateOrCreate([
                'product_id' => $product_id,
                'type' => $type,
            ], [
                'url' => $resource
            ]);
        }

    }

    public function detail(int $product_id, int $userId = 0)
    {
        $data = $this->productDao->newSelf()->where('id', $product_id)->with([
            'ProductCategoryRel',
            'ProductDescription',
            'ProductResource'
        ])->first();

        $userInfo = Context::userInfo();
        $vipStatus = $userInfo->getVipStatus();
        if($vipStatus) {
            $data->old_price = $data->price;
            $data->price = 0;
        }
        $imags_ids = $data->image_ids;
        $images = getFileFullPath(explode(',', $imags_ids));
        dump($images);
        $data->setAttribute('images', $images);

        return $data;
    }

    public function edit(int $product_id, \Hyperf\Utils\Collection $params)
    {
        Db::beginTransaction();
        try {
            $params->offsetSet('image_id', (int)$params->get('image_ids'));

            $this->productDao->edit($product_id, $params);
            $this->productDescriptionDao->updateOrCreate([
                'product_id' => $product_id,
            ], $params->only(['description'])->toArray());
            $product_category_ids = $params->get('product_category_id');
            $resource_id = $params->get('resource_id');

            $this->updateProductCategoryRel($product_id, $product_category_ids);
            $this->updateProductResource($product_id, $resource_id, 0);
            $baidu_resource = $params->get('baidu_resource');
            $this->updateProductResource($product_id, $baidu_resource, 1);
            Db::commit();
        } catch (\Exception $exception) {
            Db::rollBack();
            Error($exception->getMessage());
        }
        return $product_id;
    }
}