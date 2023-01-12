<?php

namespace YjHyperfAdminPligin\Apidog\Annotations;

use Hyperf\HttpServer\Annotation\Mapping;

#[\Attribute(\Attribute::TARGET_METHOD)]
class ApiPost extends Mapping
{
    public function __construct(public ?string $path = "", public array $methods = ['post'], public array $options = [])
    {

    }
}