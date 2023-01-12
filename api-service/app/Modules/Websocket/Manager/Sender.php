<?php

namespace App\Modules\Websocket\Manager;

use Psr\Container\ContainerInterface;

class Sender
{
    public function __construct(ContainerInterface $container)
    {
        $this->container = $container;
    }



    public function send(int $fd,string $event,array $data, $serverId = null){
        if(!is_null($serverId)){
            if($serverId != SERVER_RUN_ID){
                return false;
            }
        }
        return $this->getSender()->push($fd,json_encode(compact('event', 'data')));
    }

    public function getSender()
    {
        return $this->container->get(\Hyperf\WebSocketServer\Sender::class);
    }
}