<?php

namespace DeskFlix\Media;

use Illuminate\Filesystem\FilesystemAdapter;

trait VideoStorages
{
    /**
     * @return \Illuminate\Filesystem\FilesystemAdapter
     */
    public function getStorage(){
        return \Storage::disk($this->getDiskDriver());
    }

    protected function getDiskDriver(){ //vai pegar o driver la de config/app filesystems de cada disco
        return config('filesystems.default');
    }

    protected function getAbsolutePath(FilesystemAdapter $storage, $fileRelativePath){

        return $this->isLocalDriver()?
            $storage->getDriver()->getAdapter()->applyPathPrefix($fileRelativePath): //se for local
            $storage->url($fileRelativePath); //se for serviço de terceiros, no caso aqui s3
    }

    public function isLocalDriver(){
        $driver = config("filesystems.disks.{$this->getDiskDriver()}.driver");
        return $driver == 'local';
    }
}