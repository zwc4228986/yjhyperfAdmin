<?php

namespace App\Model\Trait;

use App\Model\Model;

class SystemFile extends Model
{
    protected array $appends = [
        'path_format'
    ];

    public function getPathFormatAttribute()
    {
        return $this->checkAttributes(['path', 'storage'], function ($path, $storage) {
            if ($storage == 'qiniu') {
                return env('QINIU_DOMAIN') . $path;
            }
            return env('WEBSITE_FILE_URL') . $path;
        });
    }
}