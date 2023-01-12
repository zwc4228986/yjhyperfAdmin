<?php

namespace App\Modules\Websocket\Pipeline\Pipes;

use App\Modules\Websocket\Manager\Sender;

class HeartBeat
{

    protected function isHeartbeat($data){
        return 'heartbeat' == $data;
    }

    public function handle($data,$next){
        if($this->isHeartbeat($data)){
            dump('heartbeat');
        }
       return $this->isHeartbeat($data)?true:$next(json_decode($data,true));
    }

}