<?php

namespace App\Modules\Admin\Dao;

use App\Model\SystemAdmin;

class SystemAdminDao extends SystemAdmin
{
    protected array $fillable = [
        'username',
        'password',
        'nickname',
        'roles',
        'last_login_ip',
        'last_login_time',
        'login_count',
        'status',
    ];

    public function read(int $adminId)
    {
        return $this->where('id', $adminId)->first();
    }
}