<?php

declare(strict_types=1);

namespace App\Model;

use Hyperf\DbConnection\Model\Model;

/**
 * @property int $id 
 * @property int $product_id 
 * @property int $cate_id 
 * @property int $add_time 
 * @property int $cate_pid 
 * @property int $status 
 */
class ProductCategoryRel extends Model
{
    /**
     * The table associated with the model.
     */
    protected ?string $table = 'product_category_rel';

    /**
     * The attributes that are mass assignable.
     */
    protected array $fillable = [];

    /**
     * The attributes that should be cast to native types.
     */
    protected array $casts = ['id' => 'integer', 'product_id' => 'integer', 'cate_id' => 'integer', 'add_time' => 'integer', 'cate_pid' => 'integer', 'status' => 'integer'];
}
