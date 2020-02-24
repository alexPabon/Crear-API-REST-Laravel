<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreMessages extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return TRUE;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            //validacion para mensaje de contacto
            'nombre'=>'required|min:3|max:255',
            'email'=>'required|email',
            'empresa'=>'',
            'tel'=>'',
            'asunto' =>'required|min:3|max:255',
            'mensaje'=>'required|min:10|max:600',
            'acepto'=>'required|boolean',
        ];
    }
    
    public function messages(){
        return [
            'nombre.required'=>'El campo del Nombre es obligatorio',
            'nombre.min'=>'El campo del Nombre minimo 3 caracteres',
            'nombre.max'=>'El campo del Nombre maximo son 255 caracteres',
            'email.required'=>'El campo del Email es obligatorio',
            'email.email'=>'El email no es correcto',
            'asunto.required'=>'El campo del Asunto es obligatorio',
            'asunto.min'=>'En el campo del asunto minimo 3 caracteres',
            'asunto.max'=>'En el campo del asunto maximo son 255 caracteres',
            'mensaje.required'=>'El campo del mensaje es obligatorio',
            'mensaje.min'=>'El campo del mensaje minimo 10 caracteres',
            'mensaje.max'=>'El campo del mensaje maximo son 600 caracteres',
            'acepto.required'=>'Debe aceptar la politica de privacidad',
            'acepto.boolean'=>'No permitido',
        ];
    }
}
