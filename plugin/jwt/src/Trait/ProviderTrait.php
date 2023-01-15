<?php
/**
 * @Notes:【】
 * @Date: 2023-01-15 23:56
 */

namespace YjHyperfAdminPligin\Jwt\Trait;

trait ProviderTrait
{
    protected string $provider;

    /**
     * @return string
     */
    public function getProvider(): string
    {
        return $this->provider.':';
    }

    /**
     * @param string $provider
     */
    public function setProvider(string $provider): self
    {
        $this->provider = $provider;
        return $this;
    }
}