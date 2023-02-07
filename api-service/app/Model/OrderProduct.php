<?php

declare(strict_types=1);

namespace App\Model;

use Hyperf\DbConnection\Model\Model;

/**
 * @property int $id 
 * @property string $order_id 
 * @property int $product_id 
 * @property string $price 
 * @property \Carbon\Carbon $create_time 
 * @property \Carbon\Carbon $update_time 
 * @property int $delete_time 
 * @property int $user_id 
 * @property int $download 
 */
class OrderProduct extends \App\Model\Trait\OrderProduct
{
    /**
     * The table associated with the model.
     */
    protected ?string $table = 'order_product';

    /**
     * The attributes that are mass assignable.
     */
    protected array $fillable = [
        'order_id',
        'user_id',
        'product_id',
        'price',
    ];

    /**
     * The attributes that should be cast to native types.
     */
    protected array $casts = ['id' => 'integer', 'product_id' => 'integer', 'create_time' => 'datetime', 'update_time' => 'datetime', 'delete_time' => 'integer', 'user_id' => 'integer', 'download' => 'integer'];
}
