<?php

namespace App\Modules\Admin\Dao;

use App\Model\Product;

class ProductDao extends Product
{
    protected array $fillable = [
        'name',
        'price',
        'status',
        'image_id',
        'image_ids',
    ];

    public function edit(int $product_id, \Hyperf\Utils\Collection $params)
    {
        $product = $this->where('id', $product_id)->first();
        $product->fill($params->toArray());
        return $product->save();

    }
}