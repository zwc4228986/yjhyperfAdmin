<?php

namespace YjHyperfAdminPligin\Framework;

class ConfigProvider
{
    public function __invoke(): array
    {
       return [
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