<?php

namespace YjHyperfAdminPligin\Framework;

use Hyperf\Contract\LengthAwarePaginatorInterface;
use YjHyperfAdminPligin\Framework\Dependencies\LengthAwarePaginator;

class ConfigProvider
{
    public function __invoke(): array
    {
       return [
           'publish' => [
               [
                   'id' => 'framework',
                   'description' => 'The config for framework.',
                   'source' => __DIR__ . '/../publish/framework.php',
                   'destination' => BASE_PATH . '/config/autoload/framework.php',
               ],
           ],
           'dependencies'=>[
               LengthAwarePaginatorInterface::class => LengthAwarePaginator::class,
           ],
           'annotations' => [
               'scan' => [
                   'paths' => [
                       __DIR__,
                   ],
               ],
           ],
       ];
    }
}