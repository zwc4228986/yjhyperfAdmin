<?php

namespace YjHyperfAdminPligin\Apidog\Annotations;

use Hyperf\HttpServer\Annotation\Mapping;

#[\Attribute(\Attribute::TARGET_METHOD)]
class ApiGet extends Mapping
{
    public function __construct(public ?string $path = "", public array $methods = ['get'], public array $options = [])
    {
        
    }
}