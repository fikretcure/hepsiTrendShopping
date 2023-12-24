<?php

namespace App\Http\Managements;

use App\Http\Repositories\ProductRepository;

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

}
