<?php

namespace YjHyperfAdminPligin\Form\Column\Traits\Search;

use YjHyperfAdminPligin\Form\Column\Templates\FieldTemplate;

trait FieldsTrait
{
    protected array $fields;

    /**
     * @return FieldTemplate[]
     */
    public function getFields(): array
    {
        return _Collect($this->fields)->transform(function ($item){
            return $item->toArray();
        })->toArray();
    }

    /**
     * @param array $fields
     */
    public function setFields(Array $fields): self
    {
        $this->fields = $fields;
        return $this;
    }

    /**
     * @param FieldTemplate $fields
     */
    public function setField(FieldTemplate $fields): self
    {
        $this->fields[] = $fields;
        return $this;
    }




}