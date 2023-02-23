<?php

namespace App\Modules\Admin\Dao;

use App\Model\Product;
use App\Model\ProductCategoryRel;
use Hyperf\Utils\Collection;
use YjHyperfAdminPligin\Framework\Dao\AddWhereQueryTrait;

class ProductDao extends Product
{
    protected array $fillable = [
        'name',
        'price',
        'status',
        'image_id',
        'image_ids',
    ];

    use AddWhereQueryTrait;

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
                $this::query()->whereIn('id', app(Circel::class)
                    ->where('circle_id', $params->get('product_category_id'))->pluck('product_id')->toArray())
            );
        }


        return $_this;
    }

    public function edit(int $product_id, \Hyperf\Utils\Collection $params)
    {
        $product = $this->where('id', $product_id)->first();
        $product->fill($params->toArray());
        return $product->save();
    }

}