<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AlunoRequest extends FormRequest
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
            'nome'          => 'required|max:50',
            'CPF'           => 'required|size:11|unique:aluno',
            'email'         => 'required',
            'turno'         => 'required',
            'nome_mae'      => 'required',
            'rua'           => 'required|max:60',
            'numero'        => 'required|max:4',
            'bairro'        => 'required|max:30',
            'cidade'        => 'required|max:40',
            'estado'        => 'required|max:40',
            'tel_celular'   => 'required|max:11',
            'tel_fixo'      => 'required|max:11',
            'escola_origem' => 'required',
            'serie'         => 'required',
            
        ];
        
    }
    public function messages()
    {
        return [
            'nome.required'        =>  'O campo :attribute não pode ficar vazio',
            'CPF.required'         =>  'O campo CPF não pode ficar vazio',
            'CPF.unique'           =>  'Este CPF é o mesmo de um dos nossos alunos, você já não foi cadastrado?',
            'CPF.size'             =>  'O campo CPF deve conter :size digitos',
            'email.required'       =>  'O campo :attribute não pode ficar vazio',
            'turno.required'       =>  'O campo :attribute não pode ficar vazio',
            'nome_mae.required'    =>  'O campo :attribute não pode ficar vazio',
            'rua.required'         =>  'O campo :attribute não pode ficar vazio',
            'rua.max'              =>  'O campo :attribute deve conter no máximo :max caracteres',
            'numero.required'      =>  'O campo :attribute não pode ficar vazio',
            'numero.max'           =>  'O campo :attribute deve conter no máximo :max caracteres',
            'bairro.required'      =>  'O campo :attribute não pode ficar vazio',
            'bairro.max'           =>  'O campo :attribute deve conter no máximo :max caracteres',
            'cidade.required'      =>  'O campo :attribute não pode ficar vazio',
            'cidade.max'           =>  'O campo :attribute deve conter no máximo :max caracteres',
            'estado.required'      =>  'O campo :attribute não pode ficar vazio',
            'estado.max'           =>  'O campo :attribute deve conter no máximo :max caracteres',
            'tel_celular.required' =>  'O campo :attribute não pode ficar vazio',
            'tel_celular.max'      =>  'O campo :attribute deve conter no máximo :max caracteres',
            'tel_fixo.required'    =>  'O campo :attribute não pode ficar vazio',
            'tel_fixo.max'         =>  'O campo :attribute deve conter no máximo :max caracteres',
          'escola_origem.required' =>  'O campo :attribute não deve ficar vazio',
            'serie.required'       =>  'O campo :attribute não deve ficar vazio',
            
        ];
    }
}
