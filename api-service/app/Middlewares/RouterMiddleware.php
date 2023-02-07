<?php

declare(strict_types=1);

namespace App\Middlewares;

use FastRoute\Dispatcher;
use Hyperf\Context\Context;
use Hyperf\Database\Query\Builder;

use Hyperf\HttpServer\Router\Dispatched;
use Hyperf\HttpServer\Router\Router;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\MiddlewareInterface;
use Psr\Http\Server\RequestHandlerInterface;

class RouterMiddleware implements MiddlewareInterface
{
    public function process(ServerRequestInterface $request, RequestHandlerInterface $handler): ResponseInterface
    {
        // TODO: Implement process() method.
        /** @var Dispatched $dispatched */
        $dispatched = $request->getAttribute(Dispatched::class);

        if ($dispatched->status === Dispatcher::NOT_FOUND) {
//            dump($request->getUri()->getPath());
//            $dispatched->status = Dispatcher::FOUND;
//             $dispatched->handler = function (){
//                dump('test');
//             };


        }

        return $handler->handle($request);
    }
}