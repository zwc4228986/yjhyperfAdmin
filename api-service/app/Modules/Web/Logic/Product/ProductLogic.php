<?php

namespace App\Modules\Web\Logic\Product;

use App\Modules\Admin\Dao\ProductCategoryRelDao;
use App\Modules\User\Dao\UserDao;
use App\Modules\Web\Dao\Product\ProductCategoryDao;
use App\Modules\Web\Dao\Product\ProductDao;
use Hyperf\Di\Annotation\Inject;
use Hyperf\Utils\Collection;

class ProductLogic
{
    #[Inject]
    protected ProductDao $productDao;

    #[Inject]
    protected ProductCategoryRelDao $productCategoryRelDao;

    #[Inject]
    protected UserDao $userDao;

    public function lists(Collection $params)
    {
        return $this->productDao->params($params)->paginate();
    }

    public function detail(int $product_id)
    {
        return $this->productDao->where('id', $product_id)->with(['Image', 'Description'])->first();
    }

    public function buy(int $userId, int $product_id)
    {
        $product = $this->productDao->where('id', $product_id)->first();
        $product_price = $product->price;
        //判断是否足够多的币
        return $this->userDao->opAccount($userId,   'integral',-$product_price,'buy_product');
    }

    public function recommand(int $product_id,int $limit=3)
    {
       $product_category_ids =  $this->productCategoryRelDao->where('product_id',$product_id)->pluck('product_category_id');
       $product_ids = $this->productCategoryRelDao->whereIn('product_category_id',$product_category_ids->toArray())->limit($limit)->pluck('product_id');
       return $this->productDao->whereIn('id',$product_ids->toArray())->get();
    }

}