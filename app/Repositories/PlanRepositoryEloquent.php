<?php

namespace DeskFlix\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use DeskFlix\Repositories\PlanRepository;
use DeskFlix\Models\Plan;
use DeskFlix\Validators\PlanValidator;

/**
 * Class PlanRepositoryEloquent
 * @package namespace DeskFlix\Repositories;
 */
class PlanRepositoryEloquent extends BaseRepository implements PlanRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return Plan::class;
    }

    

    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }
}
