<?php

namespace DeskFlix\Repositories;

use Illuminate\Http\UploadedFile;
use Prettus\Repository\Contracts\RepositoryInterface;

/**
 * Interface SerieRepository
 * @package namespace DeskFlix\Repositories;
 */
interface SerieRepository extends RepositoryInterface
{
    public function uploadThumb($id, UploadedFile $file);
}
