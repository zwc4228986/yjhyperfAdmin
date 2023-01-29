<?php

namespace YjHyperfAdminPligin\Form\Column\Templates\Traits;

trait VModelTrait
{
    protected string $vModel;

    /**
     * @return string
     */
    public function getVModel(): string
    {
        return $this->vModel;
    }

    /**
     * @param string $vModel
     */
    public function setVModel(string $vModel): self
    {
        $this->vModel = $vModel;
        return $this;
    }

}