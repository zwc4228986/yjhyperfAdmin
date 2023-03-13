<?php

namespace App\Modules\Web\Middlewares;

use App\Constants\ErrorCode;
use App\Context\UserInfoContext;
use App\Context\UserInfoContextHandle;
use App\Modules\User\Logic\User\TokenLogic;
use Firebase\JWT\JWT;
use Hyperf\Context\Context;
use Hyperf\Contract\SessionInterface;
use Hyperf\Di\Annotation\Inject;
use Hyperf\HttpServer\Contract\ResponseInterface as Response;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\MiddlewareInterface;
use Psr\Http\Server\RequestHandlerInterface;

class MustAuthMiddlerware implements MiddlewareInterface
{
    #[Inject]
    private SessionInterface $session;

    #[Inject]
    private TokenLogic $tokenLogic;

    #[Inject]
    protected UserInfoContextHandle $userInfoContextHandle;

    #[Inject]
    protected Response $response;

    public function process(ServerRequestInterface $request, RequestHandlerInterface $handler): ResponseInterface
    {
        $form_type = $request->getHeaderLine('Form-type');

        if($form_type == 'routine'){
             $this->routine($request);
        }else{
            if ($this->session->has('token')) {
                $userId = $this->tokenLogic->getUserId($this->session->get('token'));
            }
            Context::set('user_id', $userId??0);
            
            if ($userId == 0) {
                return $this->response->redirect('/');
            }
        }

        return $handler->handle($request);


    }

    public function routine($request)
    {
        $token = trim(ltrim($request->getHeaderLine('Authori-zation'), 'Bearer'));
        if ($token) {
            $userInfo = $this->userInfoContextHandle->init($token);
            Context::set('userInfo',$userInfo );
            Context::set('user_id', $userInfo->getUserId());
        } else {
            Error(ErrorCode::CODE_ERR_AUTH);
        }
    }



}