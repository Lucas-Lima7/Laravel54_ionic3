<?php

namespace DeskFlix\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class AddCpfRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'cpf' => [
                'required',
                'cpf',
                Rule::unique('users', 'cpf')
                    ->ignore($this->user('api')->id)
            ]
        ];
    }
}
