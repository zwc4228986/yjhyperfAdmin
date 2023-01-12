<?php

namespace App\Modules\Websocket\Manager;

use Psr\Container\ContainerInterface;

class Sender
{
    public function __construct(ContainerInterface $container)
    {
        $this->container = $container;
    }

    public function send(int $fd,string $event,array $data){
        return $this->getSender()->push($fd,json_encode(compact('event', 'data')));
    }

    public function getSender()
    {
        return $this->container->get(\Hyperf\WebSocketServer\Sender::class);
    }
}