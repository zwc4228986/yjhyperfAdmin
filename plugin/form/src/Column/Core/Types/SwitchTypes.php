<?php

namespace YjHyperfAdminPligin\Form\Column\Core\Types;

class SwitchTypes extends BaseTypes
{

    public $type = 'switch';


    public function setActiveValue(?int $value)
    {
        $this->setAttributes([
            'activeValue' => $value
        ]);
        return $this;
    }

    public function setInActiveValue(?int $value)
    {
        $this->setAttributes([
            'inactiveValue' => $value
        ]);
        return $this;
    }

    public function toArray()
    {
        return [
            'url' => $this->getUrl(),
            'label' => $this->getLabel(),
            'prop' => $this->getProp(),
            'type' => $this->type,
            'width' => $this->getWidth(),
        ];
    }

}