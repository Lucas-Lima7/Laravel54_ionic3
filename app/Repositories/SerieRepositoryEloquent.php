<?php

namespace DeskFlix\Repositories;

use DeskFlix\Media\ThumbsUploads;
use DeskFlix\Media\Uploads;
use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use DeskFlix\Repositories\SerieRepository;
use DeskFlix\Models\Serie;
use DeskFlix\Validators\SerieValidator;

/**
 * Class SerieRepositoryEloquent
 * @package namespace DeskFlix\Repositories;
 */
class SerieRepositoryEloquent extends BaseRepository implements SerieRepository
{
    use ThumbsUploads, Uploads;

    public function create(array $attributes)
    {
        $model = parent::create(array_except($attributes, 'thumb_file'));
        $this->uploadThumb($model->id, $attributes['thumb_file']);
        return $model;
    }

    public function update(array $attributes, $id)
    {
        $model = parent::update(array_except($attributes, 'thumb_file'), $id);
        if(isset($attributes['thumb_file'])){
            $this->uploadThumb($model->id, $attributes['thumb_file']);
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
        return Serie::class;
    }

    

    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }
}
