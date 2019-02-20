<?php

namespace DeskFlix\Media;


use Illuminate\Http\UploadedFile;

trait Uploads
{
    public function upload($model, UploadedFile $file, $type)
    {
        /** @var FilesystemAdapter $storage */
        $storage = $model->getStorage();

        $name = md5(time() . "{$model->id}--{$file->getClientOriginalName()}") . ".{$file->guessExtension()}";
        // storage / app / videos_test / serie / :id /

        $result = $storage->putFileAs($model->{"{$type}_folder_storage"}, $file, $name);

        return $result ? $name : $result;
    }

}