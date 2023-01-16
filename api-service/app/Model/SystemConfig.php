<?php

declare(strict_types=1);

namespace App\Model;

use Hyperf\DbConnection\Model\Model;

/**
 * @property int $config_id 
 * @property int $classify_id 
 * @property string $name 
 * @property string $key 
 * @property string $type 
 * @property string $config_rule 
 * @property int $required 
 * @property string $info 
 * @property int $sort 
 * @property int $user_type 
 * @property int $status 
 * @property int $delete_time 
 * @property int $update_time 
 * @property int $create_time 
 */
class SystemConfig extends Model
{
    /**
     * The table associated with the model.
     */
    protected ?string $table = 'system_config';

    /**
     * The attributes that are mass assignable.
     */
    protected array $fillable = [];

    /**
     * The attributes that should be cast to native types.
     */
    protected array $casts = ['config_id' => 'integer', 'classify_id' => 'integer', 'required' => 'integer', 'sort' => 'integer', 'user_type' => 'integer', 'status' => 'integer', 'delete_time' => 'integer', 'update_time' => 'integer', 'create_time' => 'integer'];
}
