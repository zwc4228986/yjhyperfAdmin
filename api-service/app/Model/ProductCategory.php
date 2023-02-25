<?php

declare(strict_types=1);

namespace App\Model;


/**
 * @property int $id 
 * @property int $pid 
 * @property string $name 
 * @property int $sort 
 * @property string $file_id 
 * @property int $is_show 
 * @property int $delete_time 
 * @property \Carbon\Carbon $update_time 
 * @property \Carbon\Carbon $create_time 
 * @property int $circle_id 
 */
class ProductCategory extends Model
{
    /**
     * The table associated with the model.
     */
    protected ?string $table = 'product_category';

    /**
     * The attributes that are mass assignable.
     */
    protected array $fillable = [];

    /**
     * The attributes that should be cast to native types.
     */
    protected array $casts = ['id' => 'integer', 'pid' => 'integer', 'sort' => 'integer', 'is_show' => 'integer', 'delete_time' => 'integer', 'update_time' => 'datetime', 'create_time' => 'datetime', 'circle_id' => 'integer'];


}
