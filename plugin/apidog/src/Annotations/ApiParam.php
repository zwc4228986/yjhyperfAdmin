<?php

namespace YjHyperfAdminPligin\Apidog\Annotations;

use Hyperf\Di\Annotation\AbstractAnnotation;
use YjHyperfAdminPligin\Apidog\AnnotationCollector;


#[\Attribute(\Attribute::TARGET_METHOD | \Attribute::IS_REPEATABLE)]
class ApiParam extends AbstractAnnotation
{
    public string $key;
    public string $rule;
    public string|null $default=null;
    public string|null $message=null;

    public function __construct(string $key='',string $rule='',string|null $message=null,string|null $default=null)
    {
        $this->key = $key;
        $this->rule = $rule;
        $this->default = $default;
        $this->message = $message;
    }

    public function collectMethod(string $className, ?string $target): void
    {
        AnnotationCollector::collectMethod($className, $target, static::class, $this);
    }
}