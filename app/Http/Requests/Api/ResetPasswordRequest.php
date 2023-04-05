<?php

namespace App\Http\Requests\Api;

use Illuminate\Foundation\Http\FormRequest;

class ResetPasswordRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return $this->isMethod('POST') ? $this->resetPassword() : $this->forgetPassword() ;
    }

    public function forgetPassword()
    {
        return[
            'phone' => 'required'
        ];
    }
    public function resetPassword()
    {
        return [
            'user_token' => 'required',
            'pin_code' => 'required'
        ];
    }
}
