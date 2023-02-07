<?php

namespace YjHyperfAdminPligin\Framework\Listener;

abstract class ServiceProvider
{
    abstract public function boot($serverName);
}