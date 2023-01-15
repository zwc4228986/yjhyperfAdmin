<?php

declare(strict_types=1);

namespace App\Model;

/**
 * @property int $id 
 * @property string $username 
 * @property string $password 
 * @property string $nickname 
 * @property string $roles 
 * @property string $last_login_ip 
 * @property int $last_login_time 
 * @property int $create_time 
 * @property int $login_count 
 * @property int $status 
 * @property int $update_time 
 * @property int $delete_time 
 */
class SystemAdmin extends Model
{
    /**
     * The table associated with the model.
     */
    protected ?string $table = 'system_admin';

    /**
     * The attributes that are mass assignable.
     */
    protected array $fillable = [];

    /**
     * The attributes that should be cast to native types.
     */
    protected array $casts = ['id' => 'integer', 'last_login_time' => 'integer', 'create_time' => 'integer', 'login_count' => 'integer', 'status' => 'integer', 'update_time' => 'integer', 'delete_time' => 'integer'];
}
