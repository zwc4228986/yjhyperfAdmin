<?php

namespace App\Modules\Websocket\Pipeline\Pipes\Login;

use App\Modules\Websocket\Manager\Sender;
use App\Modules\Websocket\Pipeline\BasePipe;
use App\Modules\WeChat\Logic\WechatLogic;
use Hyperf\Di\Annotation\Inject;

class CreateWechatQrcode extends BasePipe
{
    #[Inject]
    protected WechatLogic $wechatLogic;

    protected function isValid($data){
        return $data['event'] === 'create_wechat_qrcode';
    }

    protected function process($data):bool
    {
        $this->sender->send($this->getFd(),'create_wechat_qrcode',$this->wechatLogic->qrcode(SERVER_RUN_ID.'_'.$this->getFd()));
        return false;
    }

}