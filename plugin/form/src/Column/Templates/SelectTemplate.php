<?php

namespace YjHyperfAdminPligin\Form\Column\Templates;

use YjHyperfAdminPligin\Form\Column\Templates\Traits\OptionsTrait;

class SelectTemplate extends FieldTemplate
{
    use OptionsTrait;

    protected string $type = 'search-select';
}