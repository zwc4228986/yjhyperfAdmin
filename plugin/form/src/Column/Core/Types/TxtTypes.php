<?php

namespace YjHyperfAdminPligin\Form\Column\Core\Types;

class TxtTypes extends BaseTypes
{
    public $type = 'txt';

    public $format = '';


    public function format($date = 'Y-m-d H:i:s')
    {
        $this->format = $date;
        return $this;
    }

    public function toArray()
    {
        return [
            'label' => $this->getLabel(),
            'prop' => $this->getProp(),
            'type' => $this->type,
            'format' => $this->format,
            'width' => $this->getWidth(),
        ];
    }
}