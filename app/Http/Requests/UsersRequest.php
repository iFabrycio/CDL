<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UsersRequest extends FormRequest
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
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed',
            'CPF' => 'required|string|min:11|max:255|unique:users',
        ];
    }
    public function messages(){
        return [
            'name.required '=>'Por favor, coloque um nome.',
            'email.required' =>'Você precisa por um e-mail.',
            'password.required'=>'Você precisa por uma senha.',
            'CPF.required'=>'Digite um CPF',
            '*.unique'=>'CPF ou E-mail já cadastrado',
        ];
    }
}
