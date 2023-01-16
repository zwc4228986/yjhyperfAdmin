<?php

namespace App\Modules\Admin\Middlerwares;

use App\Constants\ErrorCode;
use App\Modules\Admin\Dao\SystemAdminDao;
use App\Modules\User\Logic\User\TokenLogic;
use Hyperf\Context\Context;
use Hyperf\Contract\SessionInterface;
use Hyperf\Di\Annotation\Inject;
use Hyperf\HttpServer\Contract\ResponseInterface as Response;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\MiddlewareInterface;
use Psr\Http\Server\RequestHandlerInterface;
use YjHyperfAdminPligin\Jwt\Jwt;

class MustAuthMiddlerware implements MiddlewareInterface
{

    #[Inject]
    private Jwt $jwt;

    #[Inject]
    protected Response $response;

    #[Inject]
    protected SystemAdminDao $systemAdminDao;

    public function process(ServerRequestInterface $request, RequestHandlerInterface $handler): ResponseInterface
    {
        $autouid = $request->getQueryParams()['autouid']??0;

        if(!$autouid){
            $token = $request->getHeaderLine('X-token') ?? '';
            if (!$token){
                //用户未登录
                return $this->response->json(Error('用户未登录',ErrorCode::TOEKN_NOT_EXISTS));
            }
            $admin_id = $this->jwt->guard('admin')->decode($token)->get();
        }else{
            $admin_id = $autouid;
        }

        dump($admin_id);
        if (!$admin_id){
            //登录失效
            return $this->response->json(Error('token失效',ErrorCode::TOEKN_INVALID));
        }

        $info = $this->systemAdminDao->where('id',$admin_id)->first();
        Context::set('admin_info',$info);
        Context::set('admin_id', $admin_id);

        return $handler->handle($request);
    }

}