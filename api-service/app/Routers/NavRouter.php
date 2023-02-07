<?php

namespace App\Routers;

use App\Model\Seo;
use Hyperf\Di\Annotation\Inject;
use Hyperf\HttpServer\Router\Handler;
use Hyperf\HttpServer\Router\Router;
use YjHyperfAdminPligin\Framework\Routing\UrlGenerator;

class NavRouter
{

    #[Inject]
    protected Seo $seo;

    public  function run(){
        $seo = $this->seo->get();
        $seo->transform(function(Seo $item){
                $path = '';
                $seo = $item->seo;
                if($item->module == 'product_category'){
                    $path = '/';
                    $params = ['product_category_pid' => $item->module_id];
                    UrlGenerator::$routes['/?product_category_pid='.$item->module_id] = $seo;
                }
                return compact('seo','path', 'params');
        });
//        dump(UrlGenerator::$routes);
        /** @var Handler $handler */
        $static_routers = Router::getData()['0']['GET'];
        $seo->each(function($route)use($static_routers){
            $handler = $static_routers[$route['path']];
            Router::get($route['seo'],$handler->callback,['params'=>$route['params']]);
        });
    }
}