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
use Hyperf\HttpServer\Router\Router;



Router::get('/favicon.ico', function () {
    return '';
});

app(App\Routers\NavRouter::class)->run();

Router::addServer('ws', function () {
    Router::get('/login', \App\Modules\Websocket\Controller\LoginController::class);
});

