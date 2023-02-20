<?php
/**
 * @Notes:【】
 * @Date: 2023-02-17 23:40
 */

namespace App\Modules\Sign\Dao;

use App\Modules\Sign\Model\SignTaskLogModel;
use YjHyperfAdminPligin\Framework\Dao\AddWhereQueryTrait;

class SignTaskLogDao extends SignTaskLogModel
{
    use AddWhereQueryTrait;

    public function getFinishedNum(mixed $user_id, $code)
    {
        switch ($code) {
            default:
                $count = $this->where("user_id", $user_id)->where('code', $code)->yjRangeTime('create_time', 'today')->count();
                break;
        }
        return $count;
    }
}