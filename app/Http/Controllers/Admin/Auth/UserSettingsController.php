<?php

namespace DeskFlix\Http\Controllers\Admin\Auth;

use DeskFlix\Form\UserForm;
use DeskFlix\Form\UserSettingsForm;
use DeskFlix\Models\User;
use DeskFlix\Repositories\UserRepository;
use Illuminate\Http\Request;
use DeskFlix\Http\Controllers\Controller;

class UserSettingsController extends Controller
{
    /**
     * @var UserRepository
     */
    private $repository;

    public function __construct(UserRepository $repository)
    {
        $this->repository = $repository;
    }

    public function edit()
    {
        $form = \FormBuilder::create(UserSettingsForm::class, [
            'url' => route('admin.user_settings.update'),
            'method' => 'PUT',
        ]);

        return view('admin.auth.setting', compact('form'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \DeskFlix\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $form = \FormBuilder::create(UserSettingsForm::class);

        if(!$form->isValid()){
            return redirect()
                ->back()
                ->withErrors($form->getErrors())
                ->withInput();
        }

        $data = $form->getFieldValues();
        $this->repository->update($data, \Auth::user()->id);

        $request->session()->flash('message', 'Senha alterada com sucesso.');

        return redirect()->route('admin.user_settings.edit');
    }
}
