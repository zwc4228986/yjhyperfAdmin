<?php

declare(strict_types=1);

namespace App\Model;

use Hyperf\DbConnection\Model\Model;

/**
 * @property int $id 
 * @property int $uid 
 * @property int $bargain_id 
 * @property string $bargain_price_min 
 * @property string $bargain_price 
 * @property string $price 
 * @property int $status 
 * @property int $add_time 
 * @property int $is_del 
 */
class StoreBargainUser extends Model
{
    /**
     * The table associated with the model.
     */
    protected ?string $table = 'store_bargain_user';

    /**
     * The attributes that are mass assignable.
     */
    protected array $fillable = [];

    /**
     * The attributes that should be cast to native types.
     */
    protected array $casts = ['id' => 'integer', 'uid' => 'integer', 'bargain_id' => 'integer', 'status' => 'integer', 'add_time' => 'integer', 'is_del' => 'integer'];
}
