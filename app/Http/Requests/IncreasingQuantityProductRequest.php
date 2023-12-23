<?php

namespace App\Http\Requests;

use App\Models\Order;
use App\Models\Product;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class IncreasingQuantityProductRequest extends FormRequest
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
    public function rules(): array
    {
        return [
            'product_id' => [
                'required',
                'integer',
                Rule::exists(Product::class, 'id')
            ],
            'quantity' => [
                'required',
                'integer',
                'min:1'
            ],
            'order_id' => [
                'required',
                'integer',
                Rule::exists(Order::class, 'id')->where('user_id', request()->header('X-USER-ID'))
            ]
        ];
    }
}
