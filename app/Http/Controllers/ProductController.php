<?php

namespace App\Http\Controllers;

use App\Http\Managements\ExitManagement;
use App\Http\Repositories\ProductRepository;
use App\Http\Requests\StoreProductRequest;
use App\Http\Requests\UpdateProductRequest;
use App\Http\Resources\ProductCollection;
use App\Models\Product;
use Illuminate\Http\JsonResponse;

/**
 *
 */
class ProductController extends Controller
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
     * @return JsonResponse
     */
    public function index()
    {
        return ExitManagement::ok(ProductCollection::collection($this->productRepository->all()));
    }


    /**
     * @param StoreProductRequest $request
     * @return JsonResponse
     */
    public function store(StoreProductRequest $request)
    {
        return ExitManagement::ok($this->productRepository->create($request->validated()));
    }


    /**
     * @param Product $product
     * @return void
     */
    public function show(Product $product)
    {
        //
    }


    /**
     * @param UpdateProductRequest $request
     * @param Product $product
     * @return void
     */
    public function update(UpdateProductRequest $request, Product $product)
    {
        //
    }


    /**
     * @param Product $product
     * @return void
     */
    public function destroy(Product $product)
    {
        //
    }
}
