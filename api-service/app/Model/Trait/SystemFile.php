<?php

namespace App\Model\Trait;

use App\Model\Model;

class SystemFile extends Model
{
    protected array $appends = [
        'path_format'
    ];

    public function getPathFormatAttribute(){
        return $this->checkAttributes('path',function($path){
           return env('WEBSITE_FILE_URL').$path;
        });
    }
}