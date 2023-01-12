<?php

namespace App\Modules\Websocket\Pipeline;

use App\Modules\Websocket\Manager\Sender;
use Hyperf\Context\Context;
use Hyperf\Di\Annotation\Inject;
use Hyperf\WebSocketServer\Context as WsContext;

abstract class BasePipe
{
    #[Inject]
    protected Sender $sender;
    abstract protected function isValid($data);

    abstract protected function process($data):bool;

    public function handle($data,$next){
        if($this->isValid($data)){
            if($this->process($data) === false){
                return true;
            }
        }
        return $next($data);
    }

    public function getFd(){
        return Context::get(WsContext::FD);
    }

}