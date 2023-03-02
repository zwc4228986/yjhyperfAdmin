<?php
/**
 * @Notes:【】
 * @Date: 2023-03-01 0:29
 */

namespace App\Modules\Order\Model;

use App\Model\Product;

class ProductModel extends Product
{
    public function Image()
    {
        return $this->hasOne(\App\Modules\Product\Model\SystemFileModel::class, 'id', 'image_id')->withDefault(function ($item) {
            return App(\App\Modules\Product\Model\SystemFileModel::class)->where('suffix', 'png')->first();
        });
    }
}