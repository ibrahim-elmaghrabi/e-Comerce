<?php

namespace App\Http\Requests\Api;

use Illuminate\Foundation\Http\FormRequest;

class ProductRequest extends FormRequest
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
            "name" =>  'required|max:50|string',
            'description' => 'required|between:10,200',
            'tax_number' => 'required|string|max:15',
            'category_id' => 'required|numeric|exists:categories,id',
            'store_id' => 'required|numeric|exists:stores,id',
            'price' => 'required|decimal:2|between:0,9999999999.99',
            //'quantity' => 'required|numeric|between:1,99999',
            'sizes' => 'required|array',
            'sizes.*' => 'required|array',
            'sizes.*.size' => 'required|string|max:10',
            'sizes.*.price' => 'required|string|max:10',
            'sizes.*.colors' => 'required|array',
            'sizes.*.colors.*' => 'required|exists:colors,id',



        ];
    }
}
