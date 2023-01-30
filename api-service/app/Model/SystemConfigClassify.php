<?php

declare(strict_types=1);

namespace App\Model;


/**
 * @property int $id 
 * @property int $pid 
 * @property string $name 
 * @property string $key 
 * @property string $info 
 * @property int $sort 
 * @property string $icon 
 * @property int $status 
 * @property \Carbon\Carbon $create_time 
 * @property \Carbon\Carbon $update_time 
 * @property int $delete_time 
 */
class SystemConfigClassify extends Model
{
    /**
     * The table associated with the model.
     */
    protected ?string $table = 'system_config_classify';

    /**
     * The attributes that are mass assignable.
     */
    protected array $fillable = [];

    /**
     * The attributes that should be cast to native types.
     */
    protected array $casts = ['id' => 'integer', 'pid' => 'integer', 'sort' => 'integer', 'status' => 'integer', 'create_time' => 'datetime', 'update_time' => 'datetime', 'delete_time' => 'integer'];
}
