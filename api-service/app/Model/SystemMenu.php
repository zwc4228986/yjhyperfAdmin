<?php

declare(strict_types=1);

namespace App\Model;

/**
 * @property int $id 
 * @property string $component 
 * @property string $name 
 * @property string $path 
 * @property string $title 
 * @property int $menu_id 
 * @property int $status 
 * @property string $icon 
 * @property int $hidden 
 * @property int $sort 
 * @property int $pid 
 * @property string $type 
 * @property string $params 
 * @property string $active 
 * @property \Carbon\Carbon $update_time 
 * @property int $delete_time 
 * @property \Carbon\Carbon $create_time 
 * @property string $position 
 */
class SystemMenu extends Model
{
    /**
     * The table associated with the model.
     */
    protected ?string $table = 'system_menu';

    /**
     * The attributes that are mass assignable.
     */
    protected array $fillable = [];

    /**
     * The attributes that should be cast to native types.
     */
    protected array $casts = ['id' => 'integer', 'menu_id' => 'integer', 'status' => 'integer', 'hidden' => 'integer', 'sort' => 'integer', 'pid' => 'integer', 'update_time' => 'datetime', 'delete_time' => 'integer', 'create_time' => 'datetime'];
}
