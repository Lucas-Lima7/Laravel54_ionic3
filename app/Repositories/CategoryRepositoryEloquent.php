<?php

namespace DeskFlix\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use DeskFlix\Repositories\CategoryRepository;
use DeskFlix\Models\Category;
use DeskFlix\Validators\CategoryValidator;

/**
 * Class CategoryRepositoryEloquent
 * @package namespace DeskFlix\Repositories;
 */
class CategoryRepositoryEloquent extends BaseRepository implements CategoryRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return Category::class;
    }

    

    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }
}
