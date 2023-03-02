<?php

namespace App\Modules\Circle\Model;

use App\Model\Circle;
use App\Model\SystemFile;
use App\Modules\User\Model\SystemFileModel;

class CircleModel extends Circle
{
    protected array $fillable = [
        'name',
        'circle_category_id',
        'sort',
        'is_show',
        'icon_id',
    ];

    public function Icon()
    {
        return $this->hasOne(SystemFileModel::class, 'id', 'icon_id');
    }
}