<?php

declare(strict_types=1);

namespace App\Model;

/**
 * @property int $id 
 * @property string $circle_id 
 * @property \Carbon\Carbon $create_time 
 * @property \Carbon\Carbon $update_time 
 * @property int $delete_time 
 * @property int $user_id 
 */
class CircleCollect extends Model
{
    /**
     * The table associated with the model.
     */
    protected ?string $table = 'circle_collect';

    /**
     * The attributes that are mass assignable.
     */
    protected array $fillable = [];

    /**
     * The attributes that should be cast to native types.
     */
    protected array $casts = ['id' => 'integer', 'create_time' => 'datetime', 'update_time' => 'datetime', 'delete_time' => 'integer', 'user_id' => 'integer'];
}
