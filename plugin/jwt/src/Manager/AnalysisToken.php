<?php
/**
 * @Notes:【】
 * @Date: 2023-01-15 23:44
 */

namespace YjHyperfAdminPligin\Jwt\Manager;

use YjHyperfAdminPligin\Jwt\Manager;

class AnalysisToken
{

    private Manager $manager;

    public function __construct(Manager $manager)
    {
        $this->manager = $manager;
    }

    public function get(){
        return $this->manager->getDriver()->get($this->manager->getProvider().$this->manager->getToken());
    }
}