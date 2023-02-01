<?php

declare(strict_types=1);

namespace App\Model;

use Hyperf\DbConnection\Model\Model;

/**
 * @property int $id 
 * @property string $order_id 
 * @property int $product_id 
 * @property string $price 
 * @property int $create_time 
 * @property int $update_time 
 * @property int $delete_time 
 */
class OrderProduct extends Model
{
    /**
     * The table associated with the model.
     */
    protected ?string $table = 'order_product';

    /**
     * The attributes that are mass assignable.
     */
    protected array $fillable = [];

    /**
     * The attributes that should be cast to native types.
     */
    protected array $casts = ['id' => 'integer', 'product_id' => 'integer', 'create_time' => 'integer', 'update_time' => 'integer', 'delete_time' => 'integer'];
}
