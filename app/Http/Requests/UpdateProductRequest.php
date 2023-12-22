<?php

namespace App\Http\Requests;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateProductRequest extends FormRequest
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
                'filled',
                'numeric',
                Rule::exists(Category::class, 'id')
            ],
            'name' => [
                'filled',
                Rule::unique(Product::class)->ignore($this->product),
                'string'
            ],
            'price' => [
                'filled',
                'numeric'
            ],
            'daily_stock' => [
                'filled',
                'numeric'
            ],
            'desc' => [
                'filled',
                'string'
            ],
            'avatar' => [
                'filled',
                'string'
            ],
        ];
    }
}
