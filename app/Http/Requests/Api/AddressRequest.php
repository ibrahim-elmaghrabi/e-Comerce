<?php

namespace App\Http\Requests\Api;

use Illuminate\Foundation\Http\FormRequest;

class AddressRequest extends FormRequest
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
        return [
            'city_id' => 'required|numeric|exists:cities,id',
            'user_id' => 'required|numeric|exists:users,id',
            'location' => 'required|string|max:255',
            'latitude' => 'required',
            'longitude' => 'required',

        ];
    }
}
