<?php

declare(strict_types=1);

namespace App\Model;

use Hyperf\DbConnection\Model\Model;

/**
 * @property int $id 
 * @property int $product_id 
 * @property string $title 
 * @property string $image 
 * @property string $unit_name 
 * @property int $stock 
 * @property int $sales 
 * @property string $images 
 * @property int $start_time 
 * @property int $stop_time 
 * @property string $store_name 
 * @property string $price 
 * @property string $min_price 
 * @property int $num 
 * @property string $bargain_max_price 
 * @property string $bargain_min_price 
 * @property int $bargain_num 
 * @property int $status 
 * @property string $give_integral 
 * @property string $info 
 * @property string $cost 
 * @property int $sort 
 * @property int $is_hot 
 * @property int $is_del 
 * @property int $add_time 
 * @property int $is_postage 
 * @property string $postage 
 * @property string $rule 
 * @property int $look 
 * @property int $share 
 * @property int $temp_id 
 * @property string $weight 
 * @property string $volume 
 * @property int $quota 
 * @property int $quota_show 
 * @property int $people_num 
 * @property string $logistics 
 * @property int $freight 
 * @property string $custom_form 
 * @property int $virtual_type 
 */
class StoreBargain extends Model
{
    /**
     * The table associated with the model.
     */
    protected ?string $table = 'store_bargain';

    /**
     * The attributes that are mass assignable.
     */
    protected array $fillable = [];

    /**
     * The attributes that should be cast to native types.
     */
    protected array $casts = ['id' => 'integer', 'product_id' => 'integer', 'stock' => 'integer', 'sales' => 'integer', 'start_time' => 'integer', 'stop_time' => 'integer', 'num' => 'integer', 'bargain_num' => 'integer', 'status' => 'integer', 'sort' => 'integer', 'is_hot' => 'integer', 'is_del' => 'integer', 'add_time' => 'integer', 'is_postage' => 'integer', 'look' => 'integer', 'share' => 'integer', 'temp_id' => 'integer', 'quota' => 'integer', 'quota_show' => 'integer', 'people_num' => 'integer', 'freight' => 'integer', 'virtual_type' => 'integer'];
}
