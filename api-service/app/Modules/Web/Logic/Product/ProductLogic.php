<?php

namespace App\Modules\Web\Logic\Product;

use App\Modules\Web\Dao\Product\ProductCategoryDao;
use App\Modules\Web\Dao\Product\ProductDao;
use Hyperf\Di\Annotation\Inject;

class ProductLogic
{
    #[Inject]
    protected ProductDao $productDao;

    public function lists(){
        return $this->productDao->with(['Image'])->paginate();
    }

    public function detail(int $product_id)
    {
        return $this->productDao->where('id',$product_id)->with(['Image','Description'])->first();
    }

}