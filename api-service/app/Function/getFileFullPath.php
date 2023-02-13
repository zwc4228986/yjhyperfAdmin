<?php
/**
 * @Notes:【】
 * @Date: 2023-02-04 23:53
 */

if (!function_exists('getFileFullPath')) {

    function getFileFullPath($imageId): \Hyperf\Utils\Collection
    {
        $imageIds = \Hyperf\Utils\Arr::wrap($imageId);
        $files = App(\App\Modules\Utils\File\Dao\SystemFileDao::class)->whereIn('id', $imageIds)->get();
        return collect($files)->transform(function (\App\Model\SystemFile $file) {
            return getFileDomain($file->storage) . $file->path;
        });
    }


}
