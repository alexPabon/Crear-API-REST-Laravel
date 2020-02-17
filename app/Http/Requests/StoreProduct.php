<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreProduct extends FormRequest
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
            'name'=>'required|string|min:3|max:50',
            'description'=>'required|string|min:10|max:500',
            'quantity'=>'required|integer|max:99999999',
            'status'=>'required|string|min:3|max:20',
        ];
    }
    
    public function messages()
    {
        return [
            'name.required'=>'El nombre es obligatorio y debe tener mas de 3 caracteres',
            'name.min'=>'El nombre debe tener mas de 3 caracteres',
            'name.max'=>'El nombre se excede de 50 caracteres',
            'name.string' => 'El nombre debe ser una cadena de texto',            

            'description.required'=>'La descripcion es obligatorio y debe tener mas de 10 caracteres',
            'description.min'=>'La descripcion debe tener mas de 10 caracteres',
            'description.max'=>'La descripcion se excede de 500 caracteres',
            'description.string' => 'La decripcion debe ser una cadena de texto',            

            'quantity.required'=>'La canatidad es obligatorio',
            'quantity.integer'=>'La canatidad debe ser un numero',
            'quantity.max'=>'Se excede del numero permitido',

            'status.required'=>'El estado es obligatorio y debe tener mas de 3 caracteres',
            'status.min'=>'El estado debe tener mas de 3 caracteres',
            'status.max'=>'El estado se excede de caracteres max 20',
            'status.string' => 'El estado debe ser una cadena de texto',            
        ];
    }
}
