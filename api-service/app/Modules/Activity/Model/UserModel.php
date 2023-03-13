<?php
/**
 * @Notes:【】
 * @Date: 2023-03-12 16:33
 */

namespace App\Modules\Activity\Model;

use App\Model\User;

class UserModel extends User
{
    protected array $fillable = [
        'overdue_time',
        'vip_status'
    ];
}