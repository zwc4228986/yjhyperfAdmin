<?php

declare(strict_types=1);

namespace App\Model;


/**
 * @property int $id 
 * @property string $name 
 * @property \Carbon\Carbon $create_time 
 * @property \Carbon\Carbon $update_time 
 * @property int $delete_time 
 */
class Nav extends Model
{
    /**
     * The table associated with the model.
     */
    protected ?string $table = 'nav';

    /**
     * The attributes that are mass assignable.
     */
    protected array $fillable = [];

    /**
     * The attributes that should be cast to native types.
     */
    protected array $casts = ['id' => 'integer', 'create_time' => 'datetime', 'update_time' => 'datetime', 'delete_time' => 'integer'];
}
