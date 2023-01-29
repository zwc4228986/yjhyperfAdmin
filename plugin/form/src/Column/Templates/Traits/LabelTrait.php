<?php

namespace YjHyperfAdminPligin\Form\Column\Templates\Traits;

trait LabelTrait
{
    protected string $label;

    /**
     * @return string
     */
    public function getLabel(): string
    {
        return $this->label;
    }

    /**
     * @param string $label
     */
    public function setLabel(string $label): self
    {
        $this->label = $label;
        return $this;
    }
}