<?php

namespace App\Modules\WeChat\Logic\Handler;

class ScanQrcodeLoginHandler
{
    public function __invoke(\EasyWeChat\OfficialAccount\Message $message, \Closure $next)
    {
//        dump($message);
        if ($message->MsgType === 'event' && $message->Event == 'SCAN') {

        }
        return $next($message);
    }
}