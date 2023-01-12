<?php

declare(strict_types=1);

namespace App\Model;

/**
 * @property int $id 
 * @property string $type 
 * @property string $openid 
 * @property string $unionid 
 * @property \Carbon\Carbon $create_time 
 * @property \Carbon\Carbon $update_time 
 * @property int $delete_time 
 * @property string $subscribe_scene 
 * @property int $user_id 
 */
class UserOpenid extends Model
{
    /**
     * The table associated with the model.
     */
    protected ?string $table = 'user_openid';

    /**
     * The attributes that are mass assignable.
     */
    protected array $fillable = [];

    /**
     * The attributes that should be cast to native types.
     */
    protected array $casts = ['id' => 'integer', 'create_time' => 'datetime', 'update_time' => 'datetime', 'delete_time' => 'integer', 'user_id' => 'integer'];
}
