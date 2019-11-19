<?php

namespace DeskFlix\Http\Controllers\Api;

use DeskFlix\Repositories\PlanRepository;
use DeskFlix\Http\Controllers\Controller;

class PlansController extends Controller
{
    /**
     * @var PlanRepository
     */
    private $repository;
    /**
     * PlansController constructor.
     */
    public function __construct(PlanRepository $repository)
    {
        $this->repository = $repository;
    }

    public function index()
    {
        return $this->repository->all();
    }
}
