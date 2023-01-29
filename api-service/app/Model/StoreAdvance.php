<?php

declare(strict_types=1);

namespace App\Model;

use Hyperf\DbConnection\Model\Model;

/**
 * @property int $id 
 * @property int $product_id 
 * @property string $image 
 * @property string $images 
 * @property string $title 
 * @property string $info 
 * @property string $price 
 * @property string $ot_price 
 * @property int $sort 
 * @property int $stock 
 * @property int $sales 
 * @property string $unit_name 
 * @property string $start_time 
 * @property string $stop_time 
 * @property string $add_time 
 * @property int $status 
 * @property int $is_del 
 * @property int $type 
 * @property string $deposit 
 * @property string $pay_start_time 
 * @property string $pay_stop_time 
 * @property int $deliver_time 
 * @property int $num 
 * @property int $temp_id 
 * @property int $quota 
 * @property int $quota_show 
 * @property int $once_num 
 */
class StoreAdvance extends Model
{
    /**
     * The table associated with the model.
     */
    protected ?string $table = 'store_advance';

    /**
     * The attributes that are mass assignable.
     */
    protected array $fillable = [];

    /**
     * The attributes that should be cast to native types.
     */
    protected array $casts = ['id' => 'integer', 'product_id' => 'integer', 'sort' => 'integer', 'stock' => 'integer', 'sales' => 'integer', 'status' => 'integer', 'is_del' => 'integer', 'type' => 'integer', 'deliver_time' => 'integer', 'num' => 'integer', 'temp_id' => 'integer', 'quota' => 'integer', 'quota_show' => 'integer', 'once_num' => 'integer'];
}
