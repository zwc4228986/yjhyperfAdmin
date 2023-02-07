<?php
/**
 * @Notes:【】
 * @Date: 2023-02-04 23:53
 */

if (!function_exists('getFileFullPath')) {

    function getFileFullPath($imageId): \Hyperf\Utils\Collection
    {
        $imageIds = \Hyperf\Utils\Arr::wrap($imageId);
        dump($imageIds);
        $paths = App(\App\Modules\Utils\File\Dao\SystemFileDao::class)->whereIn('id', $imageIds)->pluck('path');
        return collect($paths)->transform(function ($path) {
            return env('WEBSITE_FILE_URL') . $path;
        });
    }
}
