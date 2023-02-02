<?php

namespace App\Modules\Web\Middlewares;

use App\Modules\User\Logic\User\TokenLogic;
use Hyperf\Context\Context;
use Hyperf\Contract\SessionInterface;
use Hyperf\Di\Annotation\Inject;
use Hyperf\HttpServer\Contract\ResponseInterface as Response;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\MiddlewareInterface;
use Psr\Http\Server\RequestHandlerInterface;

class AuthMiddlerware implements MiddlewareInterface
{
    #[Inject]
    private SessionInterface $session;

    #[Inject]
    private TokenLogic $tokenLogic;

    #[Inject]
    protected Response $response;

    public function process(ServerRequestInterface $request, RequestHandlerInterface $handler): ResponseInterface
    {
        // TODO: Implement process() method.
//        dump('========');
//        dump($this->session->get('token'),'111');
        $userId = 5;
        if($this->session->has('token')){
            $userId = $this->tokenLogic->getUserId($this->session->get('token'));
        }
        dump($userId);
        if($userId){
            Context::set('user_id', $userId);
        }else{
            Context::set('user_id', 0);
        }
        dump(Context::get('user_id'));

        return $handler->handle($request);
    }

}