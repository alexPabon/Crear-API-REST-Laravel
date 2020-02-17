<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreUser extends FormRequest
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
            'name'=>'required|string|min:3|max:55',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8',
        ];
    }
    
    public function messages()
    {
        return [
            'name.required'=>'El nombre es obligatorio y debe tener mas de 3 caracteres',
            'name.min'=>'El nombre debe tener mas de 3 caracteres',
            'name.max'=>'El nombre se excede de 50 caracteres',
            'name.string' => 'El nombre debe ser una cadena de texto',

            'email.required'=>'El email es obligatorio y debe tener mas de 3 caracteres',                        
            'email.string' => 'El email debe ser una cadena de texto',
            'email.email'=>'El email debe ser una dirección de correo electrónico válida.',
            'email.max'=>'El email se excede de 255 caracteres',
            'email.unique'=>'El email ya ha sido registrado',

            'password.required'=>'La contraseña es obligatoria',
            'password.strig'=>'La contraseña debe ser una cadena de texto',
            'password.min'=>'La contraseña, minimo debe tener 8 caracteres'
        ];
    }
}
