<?php
/**
 * @Notes:【】
 * @Date: 2023-01-15 21:57
 */

return [
    'guard'=>[
        'user'=>[
            'driver'=>\Hyperf\Cache\Driver\RedisDriver::class,
            'provider'=> 'user',
        ]
    ]
];