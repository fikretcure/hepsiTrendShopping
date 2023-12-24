<?php

namespace App\Http\Requests;

use App\Models\Category;
use App\Models\Product;
use App\Rules\StorageFileExists;
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
                Rule::exists(Category::class, 'id')->where('deleted_at',null)
            ],
            'name' => [
                'filled',
                'string',
                Rule::unique(Product::class)->ignore($this->product),
            ],
            'price' => [
                'filled',
                'numeric'
            ],
            'stock' => [
                'filled',
                'integer'
            ],
            'desc' => [
                'filled',
                'string'
            ],
            'avatar' => [
                'filled',
                'string',
                new StorageFileExists()
            ]
        ];
    }
}
