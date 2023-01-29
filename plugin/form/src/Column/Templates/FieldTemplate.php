<?php

namespace YjHyperfAdminPligin\Form\Column\Templates;

use Hyperf\Utils\Str;
use YjHyperfAdminPligin\Form\Column\Templates\Traits\LabelTrait;
use YjHyperfAdminPligin\Form\Column\Templates\Traits\TypeTrait;
use YjHyperfAdminPligin\Form\Column\Templates\Traits\VModelTrait;


class FieldTemplate
{
    use LabelTrait;
    use TypeTrait;
    use VModelTrait;

    public function __construct($label='', $vModel='',$type=null)
    {
        $this->setLabel($label);
        $this->setVModel($vModel);
        $type && $this->setType($type);
    }

    public function toArray(){
        $class = static::class;
        return _Collect(class_uses_recursive($class))->mapWithKeys(function($item,$class){
            $key = lcfirst(substr(class_basename($class),0,-5));
            $fun = 'get'.Str::ucfirst($key);
            return [$key=>$this->$fun()];
        })->toArray();
    }


}