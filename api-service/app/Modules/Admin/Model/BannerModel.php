<?php

namespace App\Modules\Admin\Model;

use App\Model\Banner;
use App\Modules\Config\Model\SystemFileModel;

class BannerModel extends Banner
{

    public array $fillable = [
        'link',
        'image_id',
        'title',
        'is_show',
    ];

    public function Image()
    {
        return $this->hasOne(SystemFileModel::class, 'id', 'image_id');
    }
}