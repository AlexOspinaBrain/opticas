<?php

namespace App\Http\Requests;

use App\Rules\tamanoidcte;

use Illuminate\Foundation\Http\FormRequest;

class GuardarClienteRequest extends FormRequest
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
            //'cedula'=>'required|numeric|cliexis',
            'tiposid_id'=>'required',
            'cedula'=>['required','numeric',
                    new tamanoidcte(request()->tiposid_id),
                ],
            'nacimiento'=>'required',
            'prinom'=>'required|min:3|alpha',
            'segnom'=>'nullable|alpha|min:3',
            'priape'=>'required|min:3|alpha',
            'segape'=>'nullable|alpha',
            'ocupacion'=>'nullable|min:7',
            'email'=>'required|email',
            'direccion'=>'nullable|min:9',
            'celular'=>'required|numeric|min:3000000001|max:3999999999',
            'nacimiento'=>'required|before:today',
        ];
    }

    public function messages(){

        return[
            'celular.min' => 'El numero de celular debe ser de 10 digitos comenzando en 3',
            'celular.max' => 'El numero de celular debe ser de 10 digitos comenzando en 3',
            'nacimiento.before' => 'La fecha de nacimiento debe ser menor al día de hoy.',
        ];
    }    
}
