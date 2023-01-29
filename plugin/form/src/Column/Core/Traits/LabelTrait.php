<?php

namespace YjHyperfAdminPligin\Form\Column\Core\Traits;

trait LabelTrait
{
    protected $label = '';

    /**
     * @return string
     */
    public function getLabel()
    {
        return $this->label;
    }

    /**
     * @param string $label
     */
    public function setLabel($label)
    {
        $this->label = $label;
        return $this;
    }
}