<?php

declare(strict_types=1);

namespace App\Model;

/**
 * @property int $id 
 * @property string $phone 
 * @property string $nickname 
 * @property string $icon 
 * @property \Carbon\Carbon $update_time 
 * @property \Carbon\Carbon $create_time 
 * @property int $delete_time 
 */
class User extends Model
{
    /**
     * The table associated with the model.
     */
    protected ?string $table = 'user';

    /**
     * The attributes that are mass assignable.
     */
    protected array $fillable = [];

    /**
     * The attributes that should be cast to native types.
     */
    protected array $casts = ['id' => 'integer', 'update_time' => 'datetime', 'create_time' => 'datetime', 'delete_time' => 'integer'];
}
