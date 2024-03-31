<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Validator;

class TeacherRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }
    
    public function rules()
    {
        Validator::extend('alpha_spaces', function ($attribute, $value) {
            return preg_match('/^[\pL\s]+$/u', $value);
        });
        return [
            'tax_id' => ['required','min:11','max:11', 'regex:/^[0-9]{11}$/'],
            'biography' => 'required|string',
            'phone_number' => 'required|string|max:10|min:9',
            'motto' => 'max:100',
            'image_url' => ['nullable', 'image']
        ];
    }

    public function messages()
    {
        return [
            'tax_id.required' => 'La Partita IVA è obbligatoria',  
            'tax_id.regex' => 'La Partita IVA deve essere di soli numeri',
            'tax_id.min' => 'La Partita IVA deve essere di 11 numeri',
            'tax_id.max' => 'La Partita IVA deve essere di 11 numeri',
            'biography.required' => 'La biografia è obbligatoria',
            'biography.string' => 'La biografia deve essere un testo',
            'phone_number.numeric' => 'Il campo "Numero di telefono" deve contenere solo numeri!',
            'phone_number.required' => 'Il campo "Numero di telefono" è obbligatorio!',
            'phone_number.min' => 'Il numero di telefono deve essere di almeno 9 numeri',
            'phone_number.max' => 'Il numero di telefono deve essere massimo di 10 numeri',
            'motto.max' => 'Il motto deve essere massimo di 100 caratteri',
        ];
    }
}