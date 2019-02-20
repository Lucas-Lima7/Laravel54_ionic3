<?php

namespace DeskFlix\Repositories;

use DeskFlix\Media\ThumbsUploads;
use DeskFlix\Media\Uploads;
use DeskFlix\Media\VideosUploads;
use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use DeskFlix\Models\Video;

/**
 * Class VideoRepositoryEloquent
 * @package namespace DeskFlix\Repositories;
 */
class VideoRepositoryEloquent extends BaseRepository implements VideoRepository
{
    use ThumbsUploads, VideosUploads, Uploads;

    public function update(array $attributes, $id)
    {
        $model = parent::update($attributes, $id);
        if(isset($attributes['categories'])){
           $model->categories()->sync($attributes['categories']);
           //é pra verifificar as categorias existentes, se tiver novas, atualizar.
        }
        return $model;
    }

    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return Video::class;
    }

    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }
}
