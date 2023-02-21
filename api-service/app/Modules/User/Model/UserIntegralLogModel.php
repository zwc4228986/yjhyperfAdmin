<?php
/**
 * @Notes:【】
 * @Date: 2023-02-20 23:07
 */

namespace App\Modules\User\Model;

use App\Constants\UserIntegral;
use App\Model\UserIntegralLog;

class UserIntegralLogModel extends UserIntegralLog
{
    protected array $appends = [
        'create_time_format',
        'type_format'
    ];

    public function getCreateTimeFormatAttribute()
    {
        return $this->checkAttributes('create_time', function ($createTime) {
            return dateFormat($createTime);
        });
    }

    public function getTypeFormatAttribute()
    {
        return $this->checkAttributes('type', function ($type) {
            return UserIntegral::getMessage($type);
        });
    }
}