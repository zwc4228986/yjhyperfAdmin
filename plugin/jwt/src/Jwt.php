<?php
namespace YjHyperfAdminPligin\Jwt;
use Hyperf\Contract\ConfigInterface;
use Hyperf\Di\Annotation\Inject;

/**
 * @Notes:【】
 * @Date: 2023-01-15 21:54
 */
class Jwt
{


    #[Inject]
    protected ConfigInterface $config;

    public function guard(string $guard){
        $config = $this->config->get('jwt.guard')[$guard];
        $manager = new Manager($config['provider'], $config['driver']);
        return $manager;
    }



}