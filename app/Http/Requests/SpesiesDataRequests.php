<?php
namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Str;

class SpesiesDataRequests extends FormRequest
{
    public function authorize():bool{
        return true;
    }

    public function prepareForValidation(){
       if ($this->has('name')) {
            $this->merge([
                'name' => Str::title(trim($this->input('name'))),
            ]);
        }
      
    }
     public function rules(): array
    {
        return [
            'name' => 'required|string|max:50',
          
        ];
    }
     public function messages(): array
    {
        return [
            'name.required' => 'El nombre es obligatorio.',
            'name.string' => 'El nombre debe ser una cadena de texto.',
            'name.max' => 'El nombre no puede tener más de :max caracteres.'
        ];
    }

    
}
