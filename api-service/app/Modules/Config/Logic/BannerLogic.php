<?php

namespace App\Modules\Config\Logic;

use App\Modules\Config\Dao\BannerDao;
use Hyperf\Di\Annotation\Inject;

class BannerLogic
{
    #[Inject]
    protected BannerDao $bannerDao;

    public function lists(){
        $data = $this->bannerDao->lists();
        return $data;
    }
}