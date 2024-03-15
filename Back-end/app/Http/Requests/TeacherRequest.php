<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TeacherRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'tax_id' => ['required','min:11','max:11', 'regex:/^[0-9]{11}$/'],
            'biography' => 'required|string|max:500',
            'city' => 'required|alpha',
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
            'biography.max' => 'La biografia non deve superare i 500 caratteri',
            'city.required' => 'Il campo Città non può essere lasciato vuoto!',
            'city.alpha' => 'Il campo Città deve contenere solo lettere!',
            'phone_number.numeric' => 'Il campo "Numero di telefono" deve contenere solo numeri!',
            'phone_number.required' => 'Il campo "Numero di telefono" è obbligatorio!',
            'phone_number.min' => 'Il numero di telefono deve essere di almeno 9 numeri',
            'phone_number.max' => 'Il numero di telefono deve essere massimo di 10 numeri',
            'motto.max' => 'Il motto deve essere massimo di 100 caratteri',
        ];
    }
}