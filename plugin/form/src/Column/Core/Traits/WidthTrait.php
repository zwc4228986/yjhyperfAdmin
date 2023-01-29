<?php

namespace YjHyperfAdminPligin\Form\Column\Core\Traits;

trait WidthTrait
{
    protected $width = 'auto';

    /**
     * @return string
     */
    public function getWidth(): string
    {
        return $this->width;
    }

    /**
     * @param string $width
     */
    public function setWidth(string $width)
    {
        $this->width = $width;
        return $this;
    }

}