<?php
/**
 * @Notes:【】
 * @Date: 2023-01-17 0:37
 */

namespace App\Modules\Web\Logic;


use App\Modules\Web\Dao\NavDao;
use Hyperf\Di\Annotation\Inject;

class NavLogic
{

    #[Inject]
    protected NavDao $navDao;

    public function lists()
    {
        return $this->navDao->lists();
    }

}