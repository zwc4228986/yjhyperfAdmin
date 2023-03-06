<?php

declare(strict_types=1);

namespace App\Model;

/**
 * @property int $id 
 * @property int $product_id 
 * @property int $file_id 
 * @property \Carbon\Carbon $create_time 
 * @property \Carbon\Carbon $update_time 
 * @property int $delete_time 
 * @property int $type 
 * @property string $baidu_url 
 * @property string $baidu_code 
 */
class ProductResource extends Model
{
    /**
     * The table associated with the model.
     */
    protected ?string $table = 'product_resource';

    /**
     * The attributes that are mass assignable.
     */
    protected array $fillable = [];

    /**
     * The attributes that should be cast to native types.
     */
    protected array $casts = ['id' => 'integer', 'product_id' => 'integer', 'file_id' => 'integer', 'create_time' => 'datetime', 'update_time' => 'datetime', 'delete_time' => 'integer', 'type' => 'integer'];
}
