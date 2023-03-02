<?php

namespace App\Modules\Admin\Model;

use App\Model\ProductResource;
use Hyperf\Database\Model\SoftDeletes;

class ProductResourceModel extends ProductResource
{
    use SoftDeletes;

    protected array $fillable = [
        'product_id',
        'file_id',
        'type',
        'baidu_url',
        'baidu_code',
    ];

    public function File()
    {
        return $this->hasOne(\App\Model\SystemFile::class, 'id', 'file_id');
    }


    public function Product()
    {
        return $this->hasOne(\App\Model\Product::class, 'id', 'product_id');
    }
}