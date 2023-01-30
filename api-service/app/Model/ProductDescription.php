<?php

declare(strict_types=1);

namespace App\Model;


/**
 * @property int $product_id 
 * @property string $description 
 * @property int $type 
 * @property \Carbon\Carbon $create_time 
 * @property int $delete_time 
 * @property \Carbon\Carbon $update_time 
 */
class ProductDescription extends Model
{
    /**
     * The table associated with the model.
     */
    protected ?string $table = 'product_description';

    /**
     * The attributes that are mass assignable.
     */
    protected array $fillable = [];

    /**
     * The attributes that should be cast to native types.
     */
    protected array $casts = ['product_id' => 'integer', 'type' => 'integer', 'create_time' => 'datetime', 'delete_time' => 'integer', 'update_time' => 'datetime'];
}
