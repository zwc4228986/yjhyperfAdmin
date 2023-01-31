<?php

namespace App\Modules\Admin\Logic\Product;

use App\Model\ProductCategory;
use App\Modules\Admin\Dao\ProductCategoryDao;
use App\Modules\Admin\Dao\ProductCategoryRelDao;
use App\Modules\Admin\Dao\ProductDao;
use App\Modules\Admin\Dao\ProductDescriptionDao;
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


    public function lists(array $params)
    {
        $data = $this->productDao->orderByDesc("id")->getList();
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

    private function updateProductResource(mixed $id, int $resource_id, int $type)
    {

    }
}