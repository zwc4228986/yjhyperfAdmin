<?php

namespace App\Modules\Websocket\Pipeline;

use Hyperf\Di\Annotation\Inject;
use Hyperf\Utils\Pipeline;

class LoginPipeline extends BasePipeline
{
    protected $pipe = 'Login';

    #[Inject]
    protected Pipeline $pipeline;


    public function run($data){
        return $this->pipeline->send($data)->through($this->getPipes())->thenReturn();
    }

}