<?php

namespace YjHyperfAdminPligin\Apidog;

class ConfigProvider
{
    public function __invoke(): array
    {
       return [
           'dependencies' => [
               \Hyperf\HttpServer\Router\DispatcherFactory::class=>DispatcherFactory::class
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