<?php

namespace App\Middlewares;


use FastRoute\Dispatcher;
use Hyperf\Di\Annotation\Inject;
use Hyperf\HttpServer\Contract\RequestInterface;
use Hyperf\HttpServer\Router\Dispatched;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\MiddlewareInterface;
use Psr\Http\Server\RequestHandlerInterface;
use YjHyperfAdminPligin\Apidog\Validation;



class WebMiddleware implements MiddlewareInterface
{
    /**
     * @var RequestInterface
     */
    #[Inject]
    protected $request;

    /**
     * @var \Hyperf\HttpServer\Contract\ResponseInterface
     */
    #[Inject]
    protected $response;


    /**
     * @var Validation
     */
    #[Inject]
    protected $validater;


    public function process(ServerRequestInterface $request, RequestHandlerInterface $handler): ResponseInterface
    {
        // TODO: Implement process() method.
        $dispatched = $request->getAttribute(Dispatched::class);
        if ($dispatched->status == Dispatcher::NOT_FOUND) {
            $path = $this->dispatchRoute($request->getUri()->getPath());
            dd($path);
        }
        return $handler->handle($request);
    }

    public function  dispatchRoute($url){
        $url = str_replace('|', '/', $url);
        $url = trim($url, '/');

        if (strpos($url, '/')) {
            // [控制器/操作]
            $path = explode('/', $url);
        } else {
            $path = [$url];
        }

        return $path;
    }

}