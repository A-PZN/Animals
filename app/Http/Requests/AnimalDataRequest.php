<?php
namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Str;

class AnimalDataRequest extends FormRequest
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
       if ($this->has('species')) {
            $this->merge([
                'species' => Str::lower(trim($this->input('species'))),
            ]);
        }
    }
     public function rules(): array
    {
        return [
            'name' => 'required|string|max:255',
            'species' => 'required|string|max:255',
            'age' => 'required|integer|min:1|max:100',
        ];
    }

    
}
