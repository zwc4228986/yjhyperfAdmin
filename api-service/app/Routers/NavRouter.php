<?php

namespace App\Routers;

use App\Model\Seo;
use Hyperf\Di\Annotation\Inject;
use Hyperf\HttpServer\Router\Router;

class NavRouter
{

    #[Inject]
    protected Seo $seo;

    public  function run(){
        $seo = $this->seo->get();
        
        Router::get('/ppt',function (){
            return 111;
        });
    }

}