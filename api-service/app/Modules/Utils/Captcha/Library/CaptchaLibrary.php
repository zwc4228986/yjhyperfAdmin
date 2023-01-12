<?php

namespace App\Modules\Utils\Captcha\Library;

use Gregwar\Captcha\CaptchaBuilder;
use Gregwar\Captcha\PhraseBuilder;
use Hyperf\Di\Annotation\Inject;
use Hyperf\Snowflake\IdGeneratorInterface;
use Psr\Container\ContainerInterface;

class CaptchaLibrary
{

    #[Inject]
    protected ContainerInterface $container;

    public static function init(): static
    {
        return new static();
    }

    private function createKey():string
    {
        $generator = make(IdGeneratorInterface::class);
        return (string)$generator->generate();
    }

    private function cache($key,$code){
        $cache = $this->container->get(\Psr\SimpleCache\CacheInterface::class);
        return $cache->set('captcha' . $key, $code, 600);
    }

    public function checkCode(string $key, string $code)
    {
        $cache = $this->container->get(\Psr\SimpleCache\CacheInterface::class);

        $_code = $cache->get('captcha' . $key);

        if (!$_code) {
            err('验证码过期');
        }

        if (strtolower($_code) != strtolower($code)) {
            err('验证码错误');
        }
        
        //删除code
        $cache->delete('captcha' . $key);

        return true;
    }

    public function build(int $length=4){
        $builder = new CaptchaBuilder(null, new PhraseBuilder($length));
        $builder->build();
        $key = $this->createKey();
        $code = $builder->getPhrase();
        $image = $builder->inline();
        $this->cache($key, $code);
        return compact('key', 'image', 'code');
    }

}