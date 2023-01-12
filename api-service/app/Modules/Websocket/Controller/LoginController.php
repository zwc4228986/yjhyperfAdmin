<?php

namespace App\Modules\Websocket\Controller;

use App\Modules\Websocket\Manager\Sender;
use App\Modules\Websocket\Pipeline\LoginPipeline;
use App\Modules\WeChat\Logic\WechatLogic;
use Hyperf\Context\Context;
use Hyperf\Contract\OnCloseInterface;
use Hyperf\Contract\OnMessageInterface;
use Hyperf\Contract\OnOpenInterface;
use Hyperf\Di\Annotation\Inject;
use Hyperf\Utils\Pipeline;
use Hyperf\WebSocketServer\Context as WsContext;


class LoginController implements OnMessageInterface, OnOpenInterface, OnCloseInterface
{
    #[Inject]
    private WechatLogic $wechatLogic;

    #[Inject]
    private Sender $sender;

    private function getFd(){
       return  Context::get(WsContext::FD);
    }

    public function onMessage($server,$frame): void
    {
        App(LoginPipeline::class)->run($frame->data);
    }

    public function onClose($server, int $fd, int $reactorId): void
    {

    }

    public function onOpen($server, $request): void
    {
        //生成二维码
//        $server->push($request->fd,);
//        $this->sender->send($request->fd,'create_wechat_qrcode',$this->wechatLogic->qrcode($this->getFd()));
    }
}