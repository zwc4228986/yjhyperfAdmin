<?php

namespace YjHyperfAdminPligin\Framework\Dependencies;

class LengthAwarePaginator extends \Hyperf\Paginator\LengthAwarePaginator
{
    public function getElements(){
        return $this->elements();
    }
}