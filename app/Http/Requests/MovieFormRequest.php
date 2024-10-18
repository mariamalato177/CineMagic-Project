<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class MovieFormRequest extends FormRequest
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

        $rules = [
            'title' => 'required|string|max:255',
            'year' => 'required|integer|min:1920|max:2024',
            'genre_code' => 'required|string|exists:genres,name',
            'synopsis' => 'required|string',
            'trailer_url' => 'nullable|string',
            'custom' => 'nullable|json',
        ];

        return $rules;
    }

    public function messages(): array
    {
        return [
            'year.required' => 'Year is required',
            'year.integer' => 'Year must be an integer',
            'year.min' => 'Year must be equal or greater that 1900',
        ];
    }
}
