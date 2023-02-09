<?php

namespace App\Modules\Utils\File\Dao;

use App\Model\SystemFile;

class SystemFileDao extends SystemFile
{
    protected array $fillable = [
        'name',
        'path',
        'suffix',
        'tags_id',
        'storage',
        'size',
    ];

    public function getFullPath(int $id): string
    {
        $path = $this->where('id', $id)->value('path');
        return env('WEBSITE_FILE_URL') . $path;
    }

}