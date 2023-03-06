<?php

declare(strict_types=1);

namespace App\Model;


/**
 * @property int $id 
 * @property int $mer_id 
 * @property string $image 
 * @property string $recommend_image 
 * @property string $slider_image 
 * @property string $name 
 * @property string $info 
 * @property string $keyword 
 * @property string $bar_code 
 * @property string $cate_id 
 * @property string $price 
 * @property string $vip_price 
 * @property string $ot_price 
 * @property string $postage 
 * @property string $unit_name 
 * @property int $sort 
 * @property int $sales 
 * @property int $stock 
 * @property int $is_show 
 * @property int $is_hot 
 * @property int $is_benefit 
 * @property int $is_best 
 * @property int $is_new 
 * @property int $is_virtual 
 * @property int $virtual_type 
 * @property int $add_time 
 * @property int $is_postage 
 * @property int $is_del 
 * @property int $mer_use 
 * @property string $give_integral 
 * @property string $cost 
 * @property int $is_seckill 
 * @property int $is_bargain 
 * @property int $is_good 
 * @property int $is_sub 
 * @property int $is_vip 
 * @property int $ficti 
 * @property int $browse 
 * @property string $code_path 
 * @property string $soure_link 
 * @property string $video_link 
 * @property int $temp_id 
 * @property int $spec_type 
 * @property string $activity 
 * @property string $spu 
 * @property string $label_id 
 * @property string $command_word 
 * @property string $recommend_list 
 * @property int $vip_product 
 * @property int $presale 
 * @property int $presale_start_time 
 * @property int $presale_end_time 
 * @property int $presale_day 
 * @property string $logistics 
 * @property int $freight 
 * @property string $custom_form 
 * @property \Carbon\Carbon $update_time 
 * @property int $delete_time 
 * @property \Carbon\Carbon $create_time 
 * @property int $status 
 * @property string $image_ids 
 * @property int $image_id 
 */
class Product extends Model
{

    /**
     * The table associated with the model.
     */
    protected ?string $table = 'product';

    /**
     * The attributes that are mass assignable.
     */
    protected array $fillable = [];

    /**
     * The attributes that should be cast to native types.
     */
    protected array $casts = ['id' => 'integer', 'mer_id' => 'integer', 'sort' => 'integer', 'sales' => 'integer', 'stock' => 'integer', 'is_show' => 'integer', 'is_hot' => 'integer', 'is_benefit' => 'integer', 'is_best' => 'integer', 'is_new' => 'integer', 'is_virtual' => 'integer', 'virtual_type' => 'integer', 'add_time' => 'integer', 'is_postage' => 'integer', 'is_del' => 'integer', 'mer_use' => 'integer', 'is_seckill' => 'integer', 'is_bargain' => 'integer', 'is_good' => 'integer', 'is_sub' => 'integer', 'is_vip' => 'integer', 'ficti' => 'integer', 'browse' => 'integer', 'temp_id' => 'integer', 'spec_type' => 'integer', 'vip_product' => 'integer', 'presale' => 'integer', 'presale_start_time' => 'integer', 'presale_end_time' => 'integer', 'presale_day' => 'integer', 'freight' => 'integer', 'update_time' => 'datetime', 'delete_time' => 'integer', 'create_time' => 'datetime', 'status' => 'integer', 'image_id' => 'integer'];
}
