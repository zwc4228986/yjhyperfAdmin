<?php


namespace YjHyperfAdminPligin\Apidog;

use Hyperf\HttpServer\Annotation\Controller;
use Hyperf\HttpServer\Annotation\Mapping;
use Hyperf\HttpServer\Router\DispatcherFactory as HyperfDispatcherFactory;
use Hyperf\HttpServer\Router\RouteCollector;
use Hyperf\HttpServer\Router\Router;
use YjHyperfAdminPligin\Apidog\Annotations\Api;

class DispatcherFactory extends HyperfDispatcherFactory
{
    protected function handleController(string $className, Controller $annotation, array $methodMetadata, array $middlewares = []): void
    {
        if (!$methodMetadata) {
            return;
        }

        $router = $this->getRouter($annotation->server);

        $prefix = $this->getPrefix($className, $annotation->prefix);

        foreach ($methodMetadata as $methodName => $values) {
            $methodMiddlewares = $middlewares;
            if (isset($values)) {
                $methodMiddlewares = array_merge($methodMiddlewares, $this->handleMiddleware($values));
                $methodMiddlewares = array_unique($methodMiddlewares);
            }

            foreach ($values as $mapping) {
                if (!($mapping instanceof Mapping)) {
                    continue;
                }
                if (!isset($mapping->methods)) {
                    continue;
                }
                $path = $mapping->path;
                if ($path === '') {
                    $path = $prefix;
                } elseif ($path[0] !== '/') {
                    $path = $prefix . '/' . $path;
                }

                $router->addRoute($mapping->methods, $path, [$className, $methodName], [
                    'middleware' => $methodMiddlewares,
                ]);
            }
        }
    }
//
//    public function initConfigRoute()
//    {
////        collect($this->routers)->each(function (RouteCollector $route,$servername){
////                collect($route->getData())->each(function ($data)use($servername){
////                        collect($data)->each(function ($routes,$method)use($servername){
////                            collect($routes)->each(function ($route)use($method,$servername){
////                                dd($route,$servername,$method);
////                            });
////                        });
////                });
////        });
//        parent::initConfigRoute();
//    }
//
//
    protected function initAnnotationRoute(array $collector): void
    {

        foreach ($collector as $className => $metadata) {
            if (isset($metadata['_c'][Api::class])) {
                $middlewares = $this->handleMiddleware($metadata['_c']);
                $this->handleController($className, $metadata['_c'][Api::class], $metadata['_m'] ?? [], $middlewares);
            }
        }
        parent::initAnnotationRoute($collector);
    }
}