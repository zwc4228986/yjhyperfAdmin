<?php

namespace YjHyperfAdminPligin\Form\Column\Core\Traits;

trait PropTrait
{
    protected $prop = '';

    /**
     * @return string
     */
    public function getProp()
    {
        return $this->prop;
    }

    /**
     * @param string $prop
     */
    public function setProp($prop)
    {
        $this->prop = $prop;
        return $this;
    }
}