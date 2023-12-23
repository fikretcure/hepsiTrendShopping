<?php

namespace App\Http\Requests;

use App\Models\Category;
use App\Models\Product;
use App\Rules\UserCheckRule;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreProductRequest extends FormRequest
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
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'category_id' => [
                'required',
                Rule::exists(Category::class, 'id')
            ],
            'name' => [
                'required',
                Rule::unique(Product::class)
            ],
            'price' => [
                'required',
            ],
            'stock' => [
                'required',
            ],
            'is_daily' => [
                'required',
            ],
            'desc' => [
                'required',
            ],
            'avatar' => [
                'required',
            ]
        ];
    }
}
