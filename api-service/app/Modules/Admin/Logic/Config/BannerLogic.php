<?php

namespace App\Modules\Admin\Logic\Config;


use App\Modules\Admin\Dao\BannerDao;
use Hyperf\Di\Annotation\Inject;

class BannerLogic
{
    #[Inject]
    protected BannerDao $bannerDao;

    public function lists()
    {
        $data = $this->bannerDao->lists();
        return $data;
    }

    public function add(\Hyperf\Utils\Collection $params)
    {
        $data = $this->bannerDao->add($params);
        return $data;
    }

    public function edit($id, \Hyperf\Utils\Collection $params)
    {
        return $this->bannerDao->edit($id, $params);
    }
}