<?php
if (!function_exists('url')) {
    function url($path,$extra = [])
    {
        return app(\YjHyperfAdminPligin\Framework\Routing\UrlGenerator::class)->to($path,$extra);
    }
}
