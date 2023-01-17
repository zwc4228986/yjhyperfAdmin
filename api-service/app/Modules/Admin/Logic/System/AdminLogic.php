<?php
/**
 * @Notes:【】
 * @Date: 2023-01-16 23:34
 */

namespace App\Modules\Admin\Logic\System;

use App\Modules\Admin\Dao\SystemAdminDao;
use Hyperf\Di\Annotation\Inject;

class AdminLogic
{
    #[Inject]
    protected SystemAdminDao $systemAdminDao;

    public function detail(int $adminId)
    {
        return $this->systemAdminDao->read($adminId);
    }
}