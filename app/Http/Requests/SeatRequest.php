<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SeatSelectionRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true; 
    }

    public function rules(): array
    {
        return [
            'seats' => 'required|array|min:1',
            'seats.*' => 'required|string',
        ];
    }
}
