<?php

namespace YjHyperfAdminPligin\Form\Column\Traits\Search;

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
    public function setProp($prop): self
    {
        $this->prop = $prop;
        return $this;
    }
}