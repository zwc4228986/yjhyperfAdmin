<?php
/**
 * @Notes:【】
 * @Date: 2023-03-11 23:00
 */

namespace App\Modules\User\Model;

use App\Model\UserVipPrivilege;
use YjHyperfAdminPligin\Framework\Dao\DaoTrait;

class UserVipPrivilegeDao extends UserVipPrivilege
{
    use DaoTrait;

    public function lists()
    {
        $data = $this->newSelf()->getList();
        return $data;
    }
}