<?php

namespace YjHyperfAdminPligin\Form\Column\Templates;

use Hyperf\Utils\Str;
use YjHyperfAdminPligin\Form\Column\Types\HeaderTypes;
use YjHyperfAdminPligin\Form\Column\Types\SearchTypes;

/**
 * @method static InputTemplate input
 * @method static SelectTemplate select
 */
class Field
{
    /**
     * @param string $name
     * @param array $arguments
     * @return FieldTemplate
     */
    public static function __callStatic(string $name, array $arguments)
    {
        $name = Str::ucfirst($name);
        $name = "\YjHyperfAdminPligin\Form\Column\Templates\\{$name}Template";
        return new $name(...$arguments);
    }
}