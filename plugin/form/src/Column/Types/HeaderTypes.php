<?php

namespace YjHyperfAdminPligin\Form\Column\Types;

use Hyperf\Utils\Str;
use YjHyperfAdminPligin\Form\Column\Traits\Header\OptionsTrait;
use YjHyperfAdminPligin\Form\Column\Traits\Header\PropTrait;


class HeaderTypes
{
    use PropTrait;
    use OptionsTrait;

    public function toArray(){
        $class = static::class;
        return _Collect(class_uses_recursive($class))->mapWithKeys(function($item,$class){
                $key = Str::lower(substr(class_basename($class),0,-5));
                $fun = 'get'.Str::ucfirst($key);
                return [$key=>$this->$fun()];
        })->toArray();
    }
}