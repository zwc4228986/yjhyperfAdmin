<?php

declare(strict_types=1);

namespace App\Model;

use Hyperf\DbConnection\Model\Model;

/**
 * @property int $id 
 * @property int $uid 
 * @property int $bargain_id 
 * @property int $bargain_user_id 
 * @property string $price 
 * @property int $add_time 
 * @property int $type 
 */
class StoreBargainUserHelp extends Model
{
    /**
     * The table associated with the model.
     */
    protected ?string $table = 'store_bargain_user_help';

    /**
     * The attributes that are mass assignable.
     */
    protected array $fillable = [];

    /**
     * The attributes that should be cast to native types.
     */
    protected array $casts = ['id' => 'integer', 'uid' => 'integer', 'bargain_id' => 'integer', 'bargain_user_id' => 'integer', 'add_time' => 'integer', 'type' => 'integer'];
}
