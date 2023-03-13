<?php

declare(strict_types=1);

namespace App\Model;

use Hyperf\DbConnection\Model\Model;

/**
 * @property string $email 
 * @property int $id 
 * @property int $create_time 
 * @property int $delete_time 
 */
class Email extends Model
{
    /**
     * The table associated with the model.
     */
    protected ?string $table = 'email';

    /**
     * The attributes that are mass assignable.
     */
    protected array $fillable = [];

    /**
     * The attributes that should be cast to native types.
     */
    protected array $casts = ['id' => 'integer', 'create_time' => 'integer', 'delete_time' => 'integer'];
}
