<?php
/**
 * @Notes:【】
 * @Date: 2023-03-01 21:10
 */

namespace App\Modules\Product\Dao;

use App\Model\Circle;
use App\Model\ProductCategoryRel;
use App\Modules\Product\Model\ProductModel;
use Hyperf\Utils\Collection;
use YjHyperfAdminPligin\Framework\Dao\DaoTrait;

class ProductDao extends ProductModel
{
    use DaoTrait;

    public function params(Collection $params)
    {
        $_this = $this;
        if ($params->offsetExists('product_category_pid')) {
            $_this = $this->addWhere(
                $this::query()->whereIn('id', app(ProductCategoryRel::class)
                    ->where('product_category_pid', $params->get('product_category_pid'))->pluck('product_id')->toArray())
            );
        }

        if ($params->offsetExists('product_category_id')) {
            $_this = $this->addWhere(
                $this::query()->whereIn('id', app(ProductCategoryRel::class)
                    ->where('product_category_id', $params->get('product_category_id'))->pluck('product_id')->toArray())
            );
        }

        if ($params->offsetExists('circle_id')) {
            $_this = $this->addWhere(
                $this::query()->whereIn('id', app(Circle::class)
                    ->where('circle_id', $params->get('product_category_id'))->pluck('product_id')->toArray())
            );
        }

        return $_this;
    }


}