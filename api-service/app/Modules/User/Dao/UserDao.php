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
            dump($userId);
            $user = $this->where('id', $userId)->lock(true)->first();
            dump($user, $accountType);
            $userAccountValue = $user->{$accountType};
            dump($userAccountValue);
            if ($number < 0) {
                if (bcadd((string)$userAccountValue, (string)$number, 2) < 0) {
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

    public function createNickname()
    {
        return '抖资源' . ($this->count() + 1);
    }

    public function add($params=[])
    {
        return $this->create($params+[
            'nickname' => $this->createNickname()
        ]);
    }
}