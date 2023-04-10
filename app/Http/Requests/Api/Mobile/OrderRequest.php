<?php

namespace App\Http\Requests\Api\Mobile;

use Illuminate\Foundation\Http\FormRequest;

class OrderRequest extends FormRequest
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
        'address_id' => 'required|numeric|exists:addresses,id',
        'product_id' => 'required|exists:products,id',
        'coupon_id' => 'numeric|exists:coupons,id',
        'items' => 'required|array',
        'items.*.size_id' => 'required|exists:sizes,id',
        'items.*.color_id' => 'required|exists:colors,id',
        'items.*.quantity' => 'required|numeric|min:1',
        ];
    }
}
