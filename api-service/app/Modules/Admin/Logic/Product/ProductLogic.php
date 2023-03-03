<?php

namespace App\Modules\Admin\Logic\Product;

use App\Model\ProductCategory;
use App\Model\ProductResource;
use App\Modules\Admin\Dao\ProductCategoryDao;
use App\Modules\Admin\Dao\ProductCategoryRelDao;

use App\Modules\Admin\Dao\ProductDao;
use App\Modules\Admin\Dao\ProductDescriptionDao;
use App\Modules\Admin\Dao\ProductResourceDao;

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

    public function lists(Collection $params)
    {
        return $this->productDao->newSelf()->params($params)->orderByDesc("id")->with('Image')->getList();
    }

    public function add(\Hyperf\Utils\Collection $params)
    {
        Db::beginTransaction();
        try {
            $params->offsetSet('image_id', (int)$params->get('image_ids'));
            $product = $this->productDao-> add($params);
            $this->productDescriptionDao->updateOrCreate([
                'product_id' => $product->id,
            ], $params->only(['description'])->toArray());
            $product_category_ids = $params->get('product_category_id');

            $this->updateProductCategoryRel($product->id, $product_category_ids);
//            $resource_id = $params->get('resource_id');
//            $baidu_url = $params->get('baidu_url');
//            $baidu_code = $params->get('baidu_code');
            $this->updateProductResource($product->id, $params, 0);
            $this->updateProductResource($product->id, $params, 1);
            Db::commit();
        } catch (\Exception $exception) {
            Db::rollBack();
            Error($exception->getMessage());
        }
        return $product;
    }

    private function updateProductCategoryRel($product_id, $product_category_ids)
    {
        //先删除
        foreach ($product_category_ids as $product_category_id) {
            //获取一级导航
            $product_category_pid = $this->productCategoryDao->newSelf()->where('id', $product_category_id)->value('pid');

            $this->productCategoryRelDao->updateOrCreate([
                'product_category_pid' => $product_category_pid,
                'product_category_id' => $product_category_id,
                'product_id' => $product_id
            ]);
        }
    }

    private function updateProductResource(int $product_id, Collection $params, int $type)
    {

        if ($type == 0) {
            $resource_id = $params->get('resource_id');
            if ($resource_id) {
                $this->productResourceDao->where('product_id', $product_id)
                    ->where('type', $type)->delete();
            }

            $this->productResourceDao->updateOrCreate([
                'product_id' => $product_id,
                'type' => $type,
            ], [
                'file_id' => $resource_id
            ]);
        }

        if ($type == 1) {
            $baidu_url = $params->get('baidu_url');
            $baidu_code = $params->get('baidu_code');

            $this->productResourceDao->updateOrCreate([
                'product_id' => $product_id,
                'type' => $type,
            ], [
                'baidu_url' => $baidu_url,
                'baidu_code' => $baidu_code
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
            $this->updateProductResource($product_id, $params, 0);
            $this->updateProductResource($product_id, $params, 1);
            Db::commit();
        } catch (\Exception $exception) {
            Db::rollBack();
            Error($exception->getMessage());
        }
        return $product_id;
    }
}