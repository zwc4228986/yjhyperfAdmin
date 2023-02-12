<?php
/**
 * @Notes:【】
 * @Date: 2023-02-04 23:53
 */
if (!function_exists('getDownloadPath')) {

    function getDownloadPath($order_product_id)
    {
        return env('WEBSITE_FILE_URL') . "/web/api/download/" . $order_product_id;
    }
}
