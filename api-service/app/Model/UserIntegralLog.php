<?php

declare(strict_types=1);

namespace App\Model;

/**
 * @property int $id 
 * @property string $type 
 * @property int $number 
 * @property \Carbon\Carbon $create_time 
 * @property \Carbon\Carbon $update_time 
 * @property int $delete_time 
 * @property int $user_id 
 */
class UserIntegralLog extends Model
{
    /**
     * The table associated with the model.
     */
    protected ?string $table = 'user_integral_log';

    /**
     * The attributes that are mass assignable.
     */
    protected array $fillable = [
        'type',
        'number',
        'user_id',
    ];

    /**
     * The attributes that should be cast to native types.
     */
    protected array $casts = ['id' => 'integer', 'number' => 'integer', 'create_time' => 'datetime', 'update_time' => 'datetime', 'delete_time' => 'integer', 'user_id' => 'integer'];
}
