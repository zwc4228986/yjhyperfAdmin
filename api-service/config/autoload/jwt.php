<?php
/**
 * @Notes:【】
 * @Date: 2023-01-15 21:57
 */

return [
    'guard'=>[
        'user'=>[
            'driver'=>\Psr\SimpleCache\CacheInterface::class,
            'provider'=> 'user',
        ],
        'admin'=>[
            'driver'=>\Psr\SimpleCache\CacheInterface::class,
            'provider'=> 'admin',
        ],
    ]
];