<?php

namespace YjHyperfAdminPligin\Apidog\Annotation;

use Hyperf\Di\Annotation\AbstractAnnotation;
use Hyperf\HttpServer\Annotation\Controller;

#[\Attribute(\Attribute::TARGET_CLASS)]
class Api extends Controller
{

    public string $prefix = '';

    public string $server = 'http';

    public string $description = '';
}