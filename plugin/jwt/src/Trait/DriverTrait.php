<?php
/**
 * @Notes:【】
 * @Date: 2023-01-15 23:55
 */

namespace YjHyperfAdminPligin\Jwt\Trait;

use Psr\SimpleCache\CacheInterface;

trait DriverTrait
{
    protected CacheInterface $driver;

    /**
     * @return CacheInterface
     */
    public function getDriver(): CacheInterface
    {
        return $this->driver;
    }

    /**
     * @param CacheInterface $driver
     */
    public function setDriver(CacheInterface $driver): self
    {
        $this->driver = $driver;
        return $this;
    }
}