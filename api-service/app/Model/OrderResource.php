<?php

declare(strict_types=1);

namespace App\Model;

use Hyperf\DbConnection\Model\Model;

/**
 * @property int $id 
 * @property int $order_id 
 * @property int $product_id 
 * @property int $resource_id 
 * @property int $create_time 
 * @property int $update_time 
 * @property int $delete_time 
 * @property int $type 
 */
class OrderResource extends Model
{
    /**
     * The table associated with the model.
     */
    protected ?string $table = 'order_resource';

    /**
     * The attributes that are mass assignable.
     */
    protected array $fillable = [];

    /**
     * The attributes that should be cast to native types.
     */
    protected array $casts = ['id' => 'integer', 'order_id' => 'integer', 'product_id' => 'integer', 'resource_id' => 'integer', 'create_time' => 'integer', 'update_time' => 'integer', 'delete_time' => 'integer', 'type' => 'integer'];
}
