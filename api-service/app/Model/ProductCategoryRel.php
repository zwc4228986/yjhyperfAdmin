<?php

declare(strict_types=1);

namespace App\Model;


/**
 * @property int $id 
 * @property int $product_id 
 * @property int $product_category_id 
 * @property \Carbon\Carbon $create_time 
 * @property int $product_category_pid 
 * @property int $delete_time 
 * @property \Carbon\Carbon $update_time 
 * @property int $circle_id 
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
    protected array $casts = ['id' => 'integer', 'product_id' => 'integer', 'product_category_id' => 'integer', 'create_time' => 'datetime', 'product_category_pid' => 'integer', 'delete_time' => 'integer', 'update_time' => 'datetime', 'circle_id' => 'integer'];
}
