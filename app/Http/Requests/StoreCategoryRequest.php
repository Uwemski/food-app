<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreCategoryRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return Auth()->user->role() == 'admin' || Auth()->user->role() == 'superAdmin';
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        $categoryId = $this->route('id');
        
        return [
            //
            'name' => 'required|min:3|max:25',
            'description' => 'required|min:3|max:50',
            'image' => 'nullable|mimes:jpg,png,jpeg,pdf|max:10025',
            'is_available' => 'required|in:AVAILABLE,UN-AVAILABLE'
        ];
    }

    public function prepareForValidation()
    {
        $input = $this->all();

        foreach($input as $key => $value){
            if(is_string($input)){
                $input[$key] = strip_tags($value);
            }
        }

        $this->replace($input);
    }
}
