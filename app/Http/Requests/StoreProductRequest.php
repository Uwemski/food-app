<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreProductRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return Auth()->user()->role == 'admin' || Auth()->user()->role == 'superAdmin';
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {

        return [
            //
            // 'name' => 'required',
            // 'description' => 'required',
            // 'price' => 'required',
            // 'image' => 'nullable|mimes:png,jpg,jpeg,pdf|max:10025',
            // 'categories_id' => 'required'
        ];
    }
}
