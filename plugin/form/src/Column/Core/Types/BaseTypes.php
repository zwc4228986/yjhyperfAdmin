<?php

namespace YjHyperfAdminPligin\Form\Column\Core\Types;

use Hyperf\Utils\Contracts\Arrayable;
use YjHyperfAdminPligin\Form\Column\Core\Rules\RuleInterface;
use YjHyperfAdminPligin\Form\Column\Core\Traits\AttributesTrait;
use YjHyperfAdminPligin\Form\Column\Core\Traits\LabelTrait;
use YjHyperfAdminPligin\Form\Column\Core\Traits\PropTrait;
use YjHyperfAdminPligin\Form\Column\Core\Traits\UrlTrait;
use YjHyperfAdminPligin\Form\Column\Core\Traits\WidthTrait;

abstract class BaseTypes implements RuleInterface
{
    public $type;
    use LabelTrait;
    use PropTrait;
    use WidthTrait;
    use AttributesTrait;
    use UrlTrait;

    public function toArray()
    {
        return [
            'label' => $this->getLabel(),
            'prop' => $this->getProp(),
            'type' => $this->type,
            'width' => $this->getWidth(),
        ];
    }

}