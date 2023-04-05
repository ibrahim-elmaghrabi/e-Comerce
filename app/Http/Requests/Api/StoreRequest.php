<?php

namespace App\Http\Requests\Api;

use Illuminate\Foundation\Http\FormRequest;

class StoreRequest extends FormRequest
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
            'name' => 'required|string|max:150',
            'image'=> 'required|mimes:jpg,jpeg,png,bmp,tiff |max:4096',
            'include_vat' => 'boolean',
            'vat_percentage' => 'exclude_unless:include_vat,true|required|decimal:2|between:0,9999999999.99',

        ];
    }
}
