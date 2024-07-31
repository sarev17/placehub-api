<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PlacesRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => 'required|string|max:100',
            'slug' => 'required|string|max:120',
            'city' => 'required|string|max:50',
            'state' => 'required|string|max:2|min:2',
        ];
    }
    public function messages(): array
    {
        return [
            'name.required' => 'The name field is required.',
            'name.max' => 'The name field must not exceed 100 characters.',
            'slug.required' => 'The slug field is required.',
            'slug.max' => 'The slug field must not exceed 120 characters.',
            'city.required' => 'The city field is required.',
            'city.max' => 'The city field must not exceed 50 characters.',
            'state.required' => 'The state field is required.',
            'state.max' => 'The state field must be exactly 2 characters.',
            'state.min' => 'The state field must be exactly 2 characters.',
        ];
    }
}
