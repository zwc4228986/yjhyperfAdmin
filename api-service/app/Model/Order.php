<?php

declare(strict_types=1);

namespace App\Model;

use Hyperf\DbConnection\Model\Model;

/**
 * @property int $id 
 * @property string $order_sn 
 * @property int $user_id 
 * @property string $price 
 * @property int $create_time 
 * @property int $update_time 
 * @property int $delete_time 
 */
class Order extends \App\Model\Trait\Order
{
    /**
     * The table associated with the model.
     */
    protected ?string $table = 'order';

    /**
     * The attributes that are mass assignable.
     */
    protected array $fillable = [];

    /**
     * The attributes that should be cast to native types.
     */
    protected array $casts = ['id' => 'integer', 'user_id' => 'integer', 'create_time' => 'integer', 'update_time' => 'integer', 'delete_time' => 'integer'];
}
