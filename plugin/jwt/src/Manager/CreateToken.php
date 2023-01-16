<?php
/**
 * @Notes:【】
 * @Date: 2023-01-15 23:59
 */

namespace YjHyperfAdminPligin\Jwt\Manager;

use YjHyperfAdminPligin\Jwt\Manager;

class CreateToken
{
    private Manager $manager;

    public function __construct(Manager $manager)
    {
        $this->manager = $manager;
    }

    public function get(){
        $token = $this->manager->createToken();
        $this->manager->getDriver()->set($this->manager->getProvider().$token,$this->manager->getId());
        return $token;
    }

}