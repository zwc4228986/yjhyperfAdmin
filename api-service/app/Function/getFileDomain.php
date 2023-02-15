<?php
/**
 * @Notes:【】
 * @Date: 2023-02-13 23:04
 */
if (!function_exists('getFileDomain')) {

    function getFileDomain($type): string
    {
        return match ($type) {
            'qiniu' => env('QINIU_DOMAIN'),
            'qiniu_file' => env('QINIU_FILE_DOMAIN'),
            default => env('WEBSITE_FILE_URL')
        };
    }

}
