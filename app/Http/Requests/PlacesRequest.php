<?php

namespace App\Http\Requests;

use App\Http\Services\API\ApiResponseService;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\ValidationException;

/**
 * Create a validation for places insert
 */
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
            'city' => 'required|string|max:50',
            'state' => 'required|string|max:2|min:2',
            'slug' => 'string|unique|max:100'
        ];
    }
    public function messages(): array
    {
        return [
            'name.required' => 'The name field is required.',
            'name.max' => 'The name field must not exceed 100 characters.',
            'slug.unique' => 'The slug is already exists',
            'slug.max' => 'The slug field must not exceed 100 characters.',
            'city.required' => 'The city field is required.',
            'city.max' => 'The city field must not exceed 50 characters.',
            'state.required' => 'The state field is required.',
            'state.max' => 'The state field must be exactly 2 characters.',
            'state.min' => 'The state field must be exactly 2 characters.',
        ];
    }

    protected function failedValidation(Validator $validator)
    {
        $response = ApiResponseService::error(
            'The given data was invalid.',
            $validator->errors()->toArray(),
            422
        );
        throw new ValidationException($validator, $response);
    }
    protected function prepareForValidation()
    {
        $this->merge([
            'unique_combination' => $this->name . '|' . $this->city . '|' . $this->state,
        ]);
    }
    public function withValidator($validator)
    {
        $validator->after(function ($validator) {
            if ($this->name && $this->city && $this->state) {
                $exists = DB::table('places')
                    ->where('name', $this->name)
                    ->where('city', $this->city)
                    ->where('state', $this->state)
                    ->exists();

                if ($exists) {
                    $validator->errors()->add('data_duplicated', 'The combination of name, city, and state has already been taken.');
                }
            }
        });
    }
}
