<?php

namespace DeskFlix\Http\Controllers\Api;

use DeskFlix\Http\Requests\AddCpfRequest;
use DeskFlix\Http\Requests\UserSettingRequest;
use DeskFlix\Repositories\UserRepository;
use Illuminate\Http\Request;
use DeskFlix\Http\Controllers\Controller;

class UsersController extends Controller
{
    /**
     * @var UserRepository
     */
    private $repository;

    public function __construct(UserRepository $repository)
    {
        $this->repository = $repository;
    }

    public function updateSettings(UserSettingRequest $request)
    {
        $data = $request->only('password');
        $this->repository->update($data, $request->user('api')->id);

        return $request->user('api');
    }

    public function addCpf(AddCpfRequest $request)
    {
        $user = $this->repository->update([
            'cpf' => $request->input('cpf')
        ],$request->user('api')->id);
        return $user;
    }

}
