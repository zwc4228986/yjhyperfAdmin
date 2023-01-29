<?php

namespace YjHyperfAdminPligin\Form\Column\Traits\Header;

trait PropTrait
{
    protected $prop;

    /**
     * @return mixed
     */
    public function getProp()
    {
        return $this->prop;
    }
    /**
     * @param mixed $prop
     */
    public function setProp($prop,$default=""): self
    {
        $this->prop = $prop;
        return $this;
    }
}