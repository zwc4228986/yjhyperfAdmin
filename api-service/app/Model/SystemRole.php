<?php

declare(strict_types=1);

namespace App\Model;



/**
 * @property int $id 
 * @property string $name 
 * @property int $status 
 * @property int $delete_time 
 * @property int $update_time 
 * @property int $create_time 
 */
class SystemRole extends Model
{
    /**
     * The table associated with the model.
     */
    protected ?string $table = 'system_role';

    /**
     * The attributes that are mass assignable.
     */
    protected array $fillable = [];

    /**
     * The attributes that should be cast to native types.
     */
    protected array $casts = ['id' => 'integer', 'status' => 'integer', 'delete_time' => 'integer', 'update_time' => 'integer', 'create_time' => 'integer'];
}
