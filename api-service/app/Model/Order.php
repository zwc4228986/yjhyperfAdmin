<?php

declare(strict_types=1);

namespace App\Model;


/**
 * @property int $id
 * @property string $order_sn
 * @property int $user_id
 * @property string $price
 * @property \Carbon\Carbon $create_time
 * @property \Carbon\Carbon $update_time
 * @property int $delete_time
 */
class Order extends Model
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
    protected array $casts = ['id' => 'integer', 'user_id' => 'integer', 'create_time' => 'datetime', 'update_time' => 'datetime', 'delete_time' => 'integer'];
}
