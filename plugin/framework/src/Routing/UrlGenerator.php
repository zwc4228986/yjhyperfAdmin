<?php

namespace YjHyperfAdminPligin\Framework\Routing;

use Hyperf\Di\Annotation\Inject;
use Hyperf\HttpServer\Contract\RequestInterface;
use Hyperf\Utils\Arr;


class UrlGenerator
{
    #[Inject]
    protected RequestInterface $request;

    public function to($path,$extra=[]){

        if ($this->isValidUrl($path)) {
            return $path;
        }

        $tail = implode('/', array_map(
                'rawurlencode', (array) $this->formatParameters($extra))
        );

        [$path, $query] = $this->extractQueryString($path);

        $root = '';

        return $this->format(
                $root, '/'.trim($path.'/'.$tail, '/')
            ).$query;
    }

    public function format($root, $path)
    {
        $path = '/'.trim($path, '/');

        return trim($root.$path, '/');
    }

    protected function extractQueryString($path)
    {
        if (($queryPosition = strpos($path, '?')) !== false) {
            return [
                substr($path, 0, $queryPosition),
                substr($path, $queryPosition),
            ];
        }

        return [$path, ''];
    }

    public function formatParameters($parameters)
    {
        $parameters = Arr::wrap($parameters);

//        foreach ($parameters as $key => $parameter) {
//            if ($parameter instanceof UrlRoutable) {
//                $parameters[$key] = $parameter->getRouteKey();
//            }
//        }

        return $parameters;
    }

    public function isValidUrl($path)
    {

        if (! preg_match('~^(#|//|https?://|(mailto|tel|sms):)~', $path)) {
            return filter_var($path, FILTER_VALIDATE_URL) !== false;
        }

        return true;
    }
}