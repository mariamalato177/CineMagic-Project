<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Validator;

class CartConfirmationFormRequest extends FormRequest
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

     public function rules(): array{
        return [
            'name' => 'required|string',
            'nif' => 'nullable|digits:9',
            'email' => 'required|email:rfc,dns',
            'payment_type' => 'required|in:VISA,PAYPAL,MBWAY',
            'card_number' => $this->payment_type == 'VISA' ? 'required|digits:16' : '',
            'cvc_code' => $this->payment_type == 'VISA' ? 'required|digits:3' : '',
            'email_address' => $this->payment_type == 'PAYPAL' ? 'required|email:rfc,dns' : '',
            'phone_number' => $this->payment_type == 'MBWAY' ? 'required|digits:9' : ''
         ];

    }





}
