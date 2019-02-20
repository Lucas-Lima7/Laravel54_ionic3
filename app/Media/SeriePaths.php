<?php

namespace DeskFlix\Media;

trait SeriePaths
{
    use ThumbPaths;

    public function getThumbFolderStorageAttribute(){ //vai pegar a pasta onde esta armazenado o thumb
        return "series/{$this->id}";
        //series/1
    }

    public function getThumbAssetAttribute(){
        return $this->isLocalDriver()?
            route('admin.series.thumb_asset', ['serie' => $this->id]):
            $this->thumb_path;
    }

    public function getThumbSmallAssetAttribute(){

        return $this->isLocalDriver()?
            route('admin.series.thumb_small_asset', ['serie' => $this->id]):
            $this->thumb_small_path;
    }

    public function getThumbDefaultAttribute(){
        return env('SERIE_NO_THUMB');
    }
}