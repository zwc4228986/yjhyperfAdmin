<?php
/**
 * @Notes:【】
 * @Date: 2023-03-01 21:22
 */

namespace App\Modules\Order\Model;

use App\Model\SystemFile;

class SystemFileModel extends SystemFile
{
    protected array $appends = [
        'path_format'
    ];

    public function getPathFormatAttribute()
    {
        return $this->checkAttributes(['path', 'storage'], function ($path, $storage) {
            return getFileDomain($storage) . $path . '?imageView2/1/w/200/h/200';
        });
    }
}