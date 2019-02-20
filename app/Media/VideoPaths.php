<?php

namespace DeskFlix\Media;

trait VideoPaths
{
    use ThumbPaths;

    public function getThumbFolderStorageAttribute(){ //vai pegar a pasta onde esta armazenado o thumb
        return "videos/{$this->id}";
        //videos/1
    }

    public function getFileFolderStorageAttribute(){ //vai pegar a pasta onde esta armazenado o thumb
        return "videos/{$this->id}";
        //videos/1
    }

    public function getFileAssetAttribute(){
        return $this->isLocalDriver()?
            route('admin.videos.file_asset', ['video' => $this->id]):
            $this->file_path;
    }

    public function getThumbDefaultAttribute(){
        return env('VIDEO_NO_THUMB');
    }

    public function getFileRelativeAttribute(){
        return $this->file ? "{$this->file_folder_storage}/{$this->file}" : false;
        //series/1/thumb.jpg
    }

    public function getFilePathAttribute(){
        if($this->file_relative) {
            return $this->getAbsolutePath($this->getStorage(), $this->file_relative);
            //"C:\Users\Lucas\Documents\desenvolvimento\laravel54-ionic\storage\app\series/1/thumb.jpg"
        }
        return false;
    }

    public function getThumbAssetAttribute()
    {
        return $this->isLocalDriver()?
            route('admin.videos.thumb_asset', ['video' => $this->id]):
            $this->thumb_path;
    }

    public function getThumbSmallAssetAttribute()
    {
        return $this->isLocalDriver()?
            route('admin.videos.thumb_small_asset', ['video' => $this->id]):
            $this->thumb_small_path;
    }
}