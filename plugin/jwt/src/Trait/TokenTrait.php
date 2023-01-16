<?php
/**
 * @Notes:【】
 * @Date: 2023-01-15 23:38
 */

namespace YjHyperfAdminPligin\Jwt\Trait;

trait TokenTrait
{
    protected string $token;


    /**
     * @return string
     */
    public function createToken(): string
    {

        return time() . rand(10000, 9999999);
    }

    public function getToken(): string
    {
        return $this->token;
    }

    /**
     * @param string $token
     */
    public function setToken(string $token): self
    {
        $this->token = $token;
        return $this;
    }


}