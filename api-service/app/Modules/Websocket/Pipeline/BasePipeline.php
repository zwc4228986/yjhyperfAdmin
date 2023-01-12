<?php

namespace App\Modules\Websocket\Pipeline;

//use Hyperf\Utils\Filesystem\Filesystem;
use Hyperf\Di\Annotation\Inject;
use Hyperf\Filesystem\FilesystemFactory;
use Hyperf\Utils\Str;
use League\Flysystem\FileAttributes;
use League\Flysystem\StorageAttributes;

class BasePipeline
{
    protected $pipe = '';

    #[Inject]
    protected FilesystemFactory $filesystem;

    protected $pipePath = 'app/Modules/Websocket/Pipeline/Pipes';

    protected function getCommonPipes(){
        $data = $this->filesystem->get('app')->listContents($this->pipePath)->filter(fn (StorageAttributes $attributes) => $attributes->isFile())->map(function (FileAttributes $file){
            return str_replace('/','\\',explode('.',Str::ucfirst($file->path()))[0]);
        })->toArray();
        return $data;
    }

    protected function getPipes(){
        $path = $this->pipePath.'/'.$this->pipe;
        $data = $this->filesystem->get('app')->listContents($path)->map(function(FileAttributes $file){
            return str_replace('/','\\',explode('.',Str::ucfirst($file->path()))[0]);
        })->toArray();
        return array_merge($this->getCommonPipes(),$data);
    }
}