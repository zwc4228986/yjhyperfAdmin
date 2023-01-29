<?php

namespace YjHyperfAdminPligin\Form\Column\Traits\Header;

trait OptionsTrait
{
    protected $options = [];

    /**
     * @return array
     */
    public function getOptions(): array
    {
        return $this->options;
    }

    /**
     * @param array $options
     */
    public function setOptions(array $options): self
    {
        $this->options = $options;
        return $this;
    }


}