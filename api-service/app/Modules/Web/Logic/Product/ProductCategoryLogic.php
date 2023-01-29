<?php

namespace App\Modules\Web\Logic\Product;

use App\Modules\Web\Dao\Product\ProductCategoryDao;
use Hyperf\Di\Annotation\Inject;

class ProductCategoryLogic
{
    #[Inject]
    protected ProductCategoryDao $productCategoryDao;

    public function lists(){
        return $this->productCategoryDao->where('pid',0)->where('is_show',1)->get();
    }
    
}