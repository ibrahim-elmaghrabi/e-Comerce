<?php

namespace App\Http\Requests\Api\Mobile;

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
            'latitude' => 'required|between:-90,90',
            'longitude' => 'required|between:-180,180',
            'postal_code' => 'required|string|max:20',
            'building_number' => 'required|string|max:20',
            'location_name' => 'required|string|max:255',
        ];
    }
}
