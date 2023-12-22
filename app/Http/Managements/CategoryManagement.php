<?php

namespace App\Http\Managements;

use Illuminate\Validation\ValidationException;

/**
 *
 */
class CategoryManagement
{
    /**
     * @param $category
     * @return void
     * @throws ValidationException
     */
    public function checkUsageProduct($category): void
    {
        if (collect($category->products)->isNotEmpty()) {
            throw ValidationException::withMessages([
                'category_id' => ['Secmis oldugunuz kategori kullanilmaktadir ! ' . collect($category->products)->first()->name],
            ]);
        }
    }
}
