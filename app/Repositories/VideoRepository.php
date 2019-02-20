<?php

namespace DeskFlix\Repositories;

use Illuminate\Http\UploadedFile;
use Prettus\Repository\Contracts\RepositoryInterface;

/**
 * Interface VideoRepository
 * @package namespace DeskFlix\Repositories;
 */
interface VideoRepository extends RepositoryInterface
{
    public function uploadThumb($id, UploadedFile $file);
}
