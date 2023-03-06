<?php

namespace App\Modules\Config\Model;

use App\Model\Banner;

class BannerModel extends Banner
{
    public function Image(){
        return $this->hasOne(SystemFileModel::class,'id','image_id');
    }
}