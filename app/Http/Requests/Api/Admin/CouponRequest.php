<?php

namespace App\Http\Requests\Api\Admin;

use Illuminate\Foundation\Http\FormRequest;

class CouponRequest extends FormRequest
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
            'code' => 'required|string|max:10',
            'value' => 'required|decimal:2|between:0,9999999999.99',
            'end_at' => 'nullable|required|after:start_at|date_formate:Y-m-d',
            'start_at' => 'nullable|required|date_formate:Y-m-d',
            'store_id' => 'required|numeric|exists:stores,id',
        ];
    }
}
