<?php

namespace DeskFlix\Media;

trait ThumbPaths
{
    use VideoStorages;

    public function getThumbRelativeAttribute(){
        return $this->thumb ? "{$this->thumb_folder_storage}/{$this->thumb}" : false;
        //series/1/thumb.jpg
    }

    public function getThumbPathAttribute(){
        if($this->thumb_relative) {
            return $this->getAbsolutePath($this->getStorage(), $this->thumb_relative);
            //"C:\Users\Lucas\Documents\desenvolvimento\laravel54-ionic\storage\app\series/1/thumb.jpg"
        }
        return false;
    }

    public function getThumbSmallRelativeAttribute(){
        if($this->thumb) {
            list($name, $extension) = explode('.', $this->thumb);
            return "{$this->thumb_folder_storage}/{$name}_small.{$extension}";
        }
        return false;
    }

    public function getThumbSmallPathAttribute(){
        if($this->thumb_relative) {
            return $this->getAbsolutePath($this->getStorage(), $this->thumb_small_relative);
        }
        return false;
    }
}