<?php
/**
 * @Notes:【】
 * @Date: 2023-01-15 23:05
 */

namespace YjHyperfAdminPligin\Jwt;

use YjHyperfAdminPligin\Jwt\Manager\AnalysisToken;
use YjHyperfAdminPligin\Jwt\Manager\CreateToken;
use YjHyperfAdminPligin\Jwt\Trait\DriverTrait;
use YjHyperfAdminPligin\Jwt\Trait\IdTrait;
use YjHyperfAdminPligin\Jwt\Trait\ProviderTrait;
use YjHyperfAdminPligin\Jwt\Trait\TokenTrait;

class Manager
{
    use IdTrait;
    use TokenTrait;
    use DriverTrait;
    use ProviderTrait;


    public function __construct(string $provider,string $driver){
        $this->setProvider($provider);
        $this->setDriver(make($driver));
    }

    /**
     * @param string $token
     */
    public function decode(string $token): AnalysisToken
    {
        $this->setToken($token);
        return new AnalysisToken($this);
    }

    public function encode(int $id):CreateToken
    {
        $this->setId($id);
        return new CreateToken($this);
    }





}