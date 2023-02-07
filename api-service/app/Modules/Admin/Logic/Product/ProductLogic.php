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

    public function lists(array $params)
    {
        $data = $this->productDao->orderByDesc("id")->with('Image')->getList();
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
            $resource_id = $params->get('resource_id');
            $this->updateProductCategoryRel($product->id, $product_category_ids);
            $this->updateProductResource($product->id, $resource_id, 0);
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
            $product_category_pid = $this->productCategoryDao->where('id', $product_category_id)->value('pid');

            $this->productCategoryRelDao->updateOrCreate([
                'product_category_pid' => $product_category_pid,
                'product_category_id' => $product_category_id,
                'product_id' => $product_id
            ]);
        }
    }

    private function updateProductResource(int $product_id, int $resource_id, int $type)
    {
        $this->productResourceDao->updateOrCreate([
            'product_id' => $product_id,
            'type' => $type,
        ], [
            'file_id' => $resource_id
        ]);
    }

    public function detail($product_id)
    {
        $data = $this->productDao->where('id', $product_id)->with([
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
            $product_category_ids = $params->get('product_category_id');
            $resource_id = $params->get('resource_id');
            $this->updateProductCategoryRel($product_id, $product_category_ids);
            $this->updateProductResource($product_id, $resource_id, 0);
            Db::commit();
        } catch (\Exception $exception) {
            Db::rollBack();
            Error($exception->getMessage());
        }
        return $product_id;
    }
}