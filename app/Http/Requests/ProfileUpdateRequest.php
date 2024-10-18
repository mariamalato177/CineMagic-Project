<?php

namespace App\Http\Requests;

use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ProfileUpdateRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\Rule|array|string>
     */
    public function rules(): array
    {
        $array = [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', Rule::unique(User::class)->ignore($this->user()->id)],
            'password' => ['nullable', 'string', 'min:8', 'confirmed'],
            'nif' => ['nullable', 'string', 'size:9', 'regex:/^[0-9]*$/'],
            'payment_type' => ['nullable', 'in:VISA,PAYPAL,MBWAY'],
        ];

            if($array['payment_type'] == 'VISA'){
                $array['payment_ref'] = ['required', 'string', 'size:16', 'regex:/^[0-9]*$/'];
            }elseif($array['payment_type'] == 'PAYPAL'){
                $array['payment_ref'] = ['required', 'string', 'email'];
            }elseif($array['payment_type'] == 'MBWAY'){
                $array['payment_type'] = ['required', 'string', 'size:9', 'regex:/^[0-9]*$/'];
            }

        return $array;
    }
}
