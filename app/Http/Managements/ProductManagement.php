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
     *
     */
    public function __construct()
    {
        $this->productRepository = new ProductRepository();
    }


    /**
     * @param $product
     * @param $quantity
     * @return void
     */
    public function stockDecrement($product , $quantity): void
    {
        $product->decrement('stock', $quantity);
    }

}
