<?php

if (!function_exists('app')) {
    /**
     * Get the available container instance.
     *
     * @param string|null $abstract
     * @param array $parameters
     * @return
     */
    function app($abstract = null, array $parameters = [])
    {
        if (is_null($abstract)) {
            return \Hyperf\Utils\ApplicationContext::getContainer();
        }
        return \Hyperf\Utils\ApplicationContext::getContainer()->make($abstract, $parameters);
    }
}
