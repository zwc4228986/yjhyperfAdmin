<?php

namespace App\Context;

class UserInfoContext
{

    protected int $userId = 0;

    protected int $vip_status = 0;

    protected int $overdue_time = 0;

    /**
     * @return int
     */
    public function getUserId(): int
    {
        return $this->userId;
    }

    /**
     * @param int $userId
     */
    public function setUserId(int $userId):self
    {
        $this->userId = $userId;
        return $this;
    }

    /**
     * @return int
     */
    public function getVipStatus(): int
    {
        return $this->vip_status;
    }

    /**
     * @param int $vip_status
     */
    public function setVipStatus(int $vip_status): self
    {
        $this->vip_status = $vip_status;
        return $this;
    }

    /**
     * @return int
     */
    public function getOverdueTime(): int
    {
        return $this->overdue_time;
    }

    /**
     * @param int $overdue_time
     */
    public function setOverdueTime(int $overdue_time): self
    {
        $this->overdue_time = $overdue_time;
        return $this;
    }


}