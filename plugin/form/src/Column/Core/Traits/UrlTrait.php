<?php

namespace YjHyperfAdminPligin\Form\Column\Core\Traits;

trait UrlTrait
{
    protected $url = '';

    /**
     * @return string
     */
    public function getUrl(): string
    {
        return $this->url;
    }

    /**
     * @param string $url
     */
    public function setUrl(string $url)
    {
        $this->url = $url;
        return $this;
    }

}