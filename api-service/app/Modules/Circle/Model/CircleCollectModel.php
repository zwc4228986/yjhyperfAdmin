<?php
/**
 * @Notes:【】
 * @Date: 2023-02-24 22:39
 */

namespace App\Modules\Circle\Model;

use App\Model\CircleCollect;

class CircleCollectModel extends CircleCollect
{
    protected array $fillable = [
        'circle_id',
        'user_id',
    ];
}