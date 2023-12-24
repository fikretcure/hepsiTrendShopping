<?php

namespace App\Http\Managements;

use App\Http\Repositories\ProductRepository;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;

/**
 *
 */
class ProductManagement
{


    /**
     * @var ProductRepository
     */
    public ProductRepository $productRepository;


    /**
     * @var FileManagement
     */
    public FileManagement $fileManagement;


    /**
     *
     */
    public function __construct()
    {
        $this->productRepository = new ProductRepository();
        $this->fileManagement = new FileManagement();
    }


    /**
     * @param $product
     * @param $quantity
     * @return void
     */
    public function stockDecrement($product, $quantity): void
    {
        $product->decrement('stock', $quantity);
    }


    /**
     * @param $request
     * @return void
     */
    public function moveFile($request): void
    {
        $this->fileManagement->moveFile('public/file/' . $request->avatar, 'public/avatar/' . $request->avatar);
    }


    /**
     * @param $request
     * @return void
     * @throws ValidationException
     */
    public function checkImageType($request): void
    {
        $file_type = Str::of($request->avatar)->explode('.')->last();
        $status = collect(['png', 'jpeg', 'jpg'])->contains($file_type);
        if ($request->filled('avatar') and !$status) {
            throw ValidationException::withMessages([
                'avatar' => ['Yuklediniz dosya png,jpeg yada jpg olmalidir !'],
            ]);
        }
    }
}
