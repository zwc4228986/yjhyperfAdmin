<?php

namespace App\Modules\Admin\Logic\Product;

use App\Modules\Admin\Dao\ProductDao;
use Hyperf\Di\Annotation\Inject;

class ProductLogic
{
    #[Inject]
    protected ProductDao $productDao;

    public function lists(array $params)
    {
        $data = $this->productDao->orderByDesc("id")->getList();
        return $data;
    }


}