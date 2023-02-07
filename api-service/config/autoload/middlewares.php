<?php

declare(strict_types=1);
/**
 * This file is part of Hyperf.
 *
 * @link     https://www.hyperf.io
 * @document https://hyperf.wiki
 * @contact  group@hyperf.io
 * @license  https://github.com/hyperf/hyperf/blob/master/LICENSE
 */
return [
    'http' => [
        \App\Middlewares\CorsMiddleware::class,
        \App\Middlewares\RouterMiddleware::class,
        \Hyperf\Session\Middleware\SessionMiddleware::class,
        \YjHyperfAdminPligin\Apidog\Middlewares\ApidogMiddleware::class
    ],
];
