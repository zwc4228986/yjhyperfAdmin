<?php

namespace YjHyperfAdminPligin\Apidog\Annotation;

use Hyperf\HttpServer\Annotation\Mapping;

#[\Attribute(\Attribute::TARGET_METHOD)]
class ApiPost extends Mapping
{
    public ?string $path;

    public array $methods = ['POST'];

}