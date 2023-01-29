<?php
/**
 * Created by PhpStorm
 * User: honglin
 * Date: 2022/8/5
 * Time: 下午3:10
 */

namespace YjHyperfAdminPligin\Form\Column\Core\Traits;

trait AttributesTrait
{
    protected $attributes = [];

    /**
     * @return array
     */
    public function getAttributes(): array
    {
        return $this->attributes;
    }

    /**
     * @param array $attributes
     */
    public function setAttributes(array $attributes)
    {
        $this->attributes += $attributes;
        return $this;
    }


}