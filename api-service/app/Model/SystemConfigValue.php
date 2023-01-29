<?php

declare(strict_types=1);

namespace App\Model;


/**
 * @property int $config_value_id 
 * @property string $type 
 * @property string $key 
 * @property string $value 
 * @property int $mer_id 
 * @property int $delete_time 
 * @property int $create_time 
 * @property int $update_time 
 */
class SystemConfigValue extends Model
{
    /**
     * The table associated with the model.
     */
    protected ?string $table = 'system_config_value';

    /**
     * The attributes that are mass assignable.
     */
    protected array $fillable = [];

    /**
     * The attributes that should be cast to native types.
     */
    protected array $casts = ['config_value_id' => 'integer', 'mer_id' => 'integer', 'delete_time' => 'integer', 'create_time' => 'integer', 'update_time' => 'integer'];
}
