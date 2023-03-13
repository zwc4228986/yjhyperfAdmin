<?php
/**
 * @Notes:【】
 * @Date: 2023-03-01 21:10
 */

namespace App\Modules\Product\Dao;

use App\Model\Circle;
use App\Model\CircleCategory;
use App\Model\ProductCategoryRel;
use App\Modules\Product\Model\ProductModel;
use Hyperf\Utils\Collection;
use YjHyperfAdminPligin\Framework\Dao\DaoTrait;

class ProductDao extends ProductModel
{
    use DaoTrait;

    public function params(Collection $params)
    {

        $params->check('product_category_pid', [0, '0', null], function ($product_category_id) {
            $this->addWhere(
                $this::query()->whereIn('id', app(ProductCategoryRel::class)
                    ->where('product_category_pid', $product_category_id)->pluck('product_id')->toArray())
            );
        });

        $params->check('product_category_id', [0, '0', null], function ($product_category_id) {
            $this->addWhere(
                $this::query()->whereIn('id', app(ProductCategoryRel::class)
                    ->where('product_category_id', $product_category_id)->pluck('product_id')->toArray())
            );
        });


        $params->check('circle_id', [0, null], function ($circle_id) {
            $this->addWhere(
                $this::query()->whereIn('id', app(ProductCategoryRel::class)
                    ->where('circle_id', $circle_id)->pluck('product_id')->toArray())
            );
        });

        $params->check('circle_category_id', [0, null], function ($circle_category_id) {
            $circle_ids = app(Circle::class)
                ->where('circle_category_id', $circle_category_id)->pluck('id');

            $this->addWhere(
                $this::query()->whereIn('id', app(ProductCategoryRel::class)
                    ->whereIn('circle_id', $circle_ids->toArray())->pluck('product_id')->toArray())
            );
        });

        return $this;
    }


}