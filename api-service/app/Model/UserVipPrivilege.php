<?php

declare(strict_types=1);

namespace App\Model;

/**
 * @property int $id 
 * @property string $name 
 * @property string $desc 
 * @property int $image_id 
 * @property int $delete_time 
 * @property \Carbon\Carbon $create_time 
 * @property \Carbon\Carbon $update_time 
 */
class UserVipPrivilege extends Model
{
    /**
     * The table associated with the model.
     */
    protected ?string $table = 'user_vip_privilege';

    /**
     * The attributes that are mass assignable.
     */
    protected array $fillable = [];

    /**
     * The attributes that should be cast to native types.
     */
    protected array $casts = ['id' => 'integer', 'image_id' => 'integer', 'delete_time' => 'integer', 'create_time' => 'datetime', 'update_time' => 'datetime'];
}
