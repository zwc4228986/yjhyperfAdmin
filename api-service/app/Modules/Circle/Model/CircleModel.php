<?php

namespace App\Modules\Circle\Model;

use App\Model\Circle;

class CircleModel  extends Circle
{
    protected array $fillable = [
        'name',
        'circle_category_id',
        'sort',
        'is_show',
        'icon_id',
    ];
}