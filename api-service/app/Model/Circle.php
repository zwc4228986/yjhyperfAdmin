<?php

declare(strict_types=1);

namespace App\Model;

/**
 * @property int $id 
 * @property string $name 
 * @property \Carbon\Carbon $create_time 
 * @property \Carbon\Carbon $update_time 
 * @property int $delete_time 
 * @property int $collect_num 
 * @property string $info 
 * @property int $icon_id 
 */
class Circle extends Model
{
    /**
     * The table associated with the model.
     */
    protected ?string $table = 'circle';

    /**
     * The attributes that are mass assignable.
     */
    protected array $fillable = [];

    /**
     * The attributes that should be cast to native types.
     */
    protected array $casts = ['id' => 'integer', 'create_time' => 'datetime', 'update_time' => 'datetime', 'delete_time' => 'integer', 'collect_num' => 'integer', 'icon_id' => 'integer'];
}
