<?php

declare(strict_types=1);

namespace App\Model;

use Hyperf\DbConnection\Model\Model;

/**
 * @property int $id 
 * @property int $uid 
 * @property string $title 
 * @property int $number 
 * @property int $balance 
 * @property int $add_time 
 */
class UserSign extends Model
{
    /**
     * The table associated with the model.
     */
    protected ?string $table = 'user_sign';

    /**
     * The attributes that are mass assignable.
     */
    protected array $fillable = [];

    /**
     * The attributes that should be cast to native types.
     */
    protected array $casts = ['id' => 'integer', 'uid' => 'integer', 'number' => 'integer', 'balance' => 'integer', 'add_time' => 'integer'];
}
