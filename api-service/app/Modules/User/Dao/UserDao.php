<?php

namespace App\Modules\User\Dao;

use App\Model\User;
use App\Model\UserIntegralLog;
use Hyperf\DbConnection\Db;

class UserDao extends User
{
    protected array $fillable = [
        'phone',
        'integral',
        'nickname'
    ];

    public function read(int $id)
    {
        return $this->where('id', $id)->first();
    }

    public function opAccount(int $userId, string $accountType, int|float $number, string $logType)
    {
        Db::beginTransaction();
        try {
            $user = $this->where('user_id', $userId)->lock(true)->first();
            $userAccountValue = $user->{$accountType};
            if ($number < 0) {
                if (bcadd($userAccountValue, $number, 2) < 0) {
                    Error('积分不足');
                }
            }
            $user->increment($accountType, $number);
            $this->AddAccount($userId, $logType, $number);
            Db::commit();
        } catch (\Exception $exception) {
            Db::rollback();
            Error($exception->getMessage());
        }
        return true;
    }

    public function AddAccount($userId, $logType, $number)
    {
        return App(UserIntegralLog::class)->create([
            'type' => $logType,
            'user_id' => $userId,
            'number' => $number,
        ]);
    }

}