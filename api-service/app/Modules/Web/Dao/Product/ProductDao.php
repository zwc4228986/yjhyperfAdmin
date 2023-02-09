<?php

namespace App\Modules\Web\Dao\Product;

use App\Model\Product;
use App\Model\ProductCategory;
use App\Model\ProductCategoryRel;
use Hyperf\Utils\Collection;
use YjHyperfAdminPligin\Framework\Dao\AddWhereQueryTrait;

class ProductDao extends Product
{
    use AddWhereQueryTrait;

    public function params(Collection $params)
    {
        $_this = $this;
        if($params->offsetExists('product_category_pid')){
             $_this =  $this->addWhere(
                $this::query()->whereIn('id',app(ProductCategoryRel::class)
                    ->where('product_category_pid',$params->get('product_category_pid'))->pluck('product_id')->toArray())
            );
        }

        if($params->offsetExists('product_category_id')){
            $_this = $this->addWhere(
                $this::query()->whereIn('id',app(ProductCategoryRel::class)
                    ->where('product_category_id',$params->get('product_category_id'))->pluck('product_id')->toArray())
            );
        }

        return $_this;
    }
}