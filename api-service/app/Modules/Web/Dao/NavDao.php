<?php
/**
 * @Notes:【】
 * @Date: 2023-01-17 0:37
 */

namespace App\Modules\Web\Dao;

use App\Model\Nav;

class NavDao extends Nav
{
    public function lists()
    {
        return $this->get();
    }
}