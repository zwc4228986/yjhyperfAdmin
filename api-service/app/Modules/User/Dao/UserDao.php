<?php

namespace App\Modules\User\Dao;

use App\Model\User;

class UserDao extends User
{
    protected array $fillable = [
        'phone',
        'nickname'
    ];

    public function read(int $id)
    {
        return $this->where('id', $id)->first();
    }

}