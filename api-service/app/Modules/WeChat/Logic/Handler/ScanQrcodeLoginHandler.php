<?php

namespace App\Modules\WeChat\Logic\Handler;

use App\Modules\User\Logic\Login\ScanQrcodeLogic;
use Hyperf\Di\Annotation\Inject;

class ScanQrcodeLoginHandler
{
    #[Inject]
    protected ScanQrcodeLogic $scanQrcodeLogic;

    public function __invoke(\EasyWeChat\OfficialAccount\Message $message, \Closure $next)
    {
        if ($message->MsgType === 'event' && $message->Event == 'SCAN') {
                [$serviceId , $fd] = explode('_',$message->EventKey);

                $openid = $message->FromUserName;
                dump($openid);
                $this->scanQrcodeLogic->wechat($openid,$serviceId, $fd);
        }
        return $next($message);
    }
}