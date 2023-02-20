<?php

declare(strict_types=1);

namespace App\Model;

use Hyperf\DbConnection\Model\Model;

/**
 * @property int $id 
 * @property string $name 
 * @property int $status 
 * @property int $point 
 * @property int $create_time 
 * @property int $update_time 
 * @property int $delete_time 
 */
class Sign extends Model
{
    /**
     * The table associated with the model.
     */
    protected ?string $table = 'sign';

    /**
     * The attributes that are mass assignable.
     */
    protected array $fillable = [];

    /**
     * The attributes that should be cast to native types.
     */
    protected array $casts = ['id' => 'integer', 'status' => 'integer', 'point' => 'integer', 'create_time' => 'integer', 'update_time' => 'integer', 'delete_time' => 'integer'];
}
