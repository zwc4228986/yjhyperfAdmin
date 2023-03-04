<?php

namespace App\Modules\Admin\Dao;

use App\Model\Circle;
use App\Model\Product;
use App\Model\ProductCategoryRel;
use App\Modules\Admin\Model\ProductModel;
use Hyperf\Utils\Collection;
use YjHyperfAdminPligin\Framework\Dao\AddWhereQueryTrait;
use YjHyperfAdminPligin\Framework\Dao\DaoTrait;

class ProductDao extends ProductModel
{

    protected array $fillable = [
        'name',
        'price',
        'status',
        'image_id',
        'image_ids',
    ];

    use DaoTrait;

    public function params(Collection $params)
    {

        $params->check('product_category_id', [0, '0', null], function ($product_category_id) {
            dd($product_category_id);
            $this->addWhere(
                $this::query()->whereIn('id', app(ProductCategoryRel::class)
                    ->where('product_category_id', $product_category_id)->pluck('product_id')->toArray())
            );
        });

        $params->check('circle_id', [0, null], function ($circle_id) {
            $this->addWhere(
                $this::query()->whereIn('id', app(Circle::class)
                    ->where('circle_id', $circle_id)->pluck('product_id')->toArray())
            );
        });


        return $this;
    }

    public function edit(int $product_id, \Hyperf\Utils\Collection $params)
    {
        $product = $this->newSelf()->where('id', $product_id)->first();
        $product->fill($params->toArray());
        return $product->save();
    }

    public function isBuy(int $product_id, int $userId)
    {

    }

    public function add($params)
    {
        return $this->create($params->toArray());
    }
}