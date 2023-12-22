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
    public function index(): JsonResponse
    {
        return ExitManagement::ok(ProductCollection::collection($this->productRepository->all()));
    }


    /**
     * @param StoreProductRequest $request
     * @return JsonResponse
     */
    public function store(StoreProductRequest $request): JsonResponse
    {
        $store = $this->productRepository->create($request->validated());
        return ExitManagement::ok(ProductCollection::make($store));
    }


    /**
     * @param Product $product
     * @return JsonResponse
     */
    public function show(Product $product): JsonResponse
    {
        return ExitManagement::ok(ProductCollection::make($product));
    }


    /**
     * @param UpdateProductRequest $request
     * @param Product $product
     * @return JsonResponse
     */
    public function update(UpdateProductRequest $request, Product $product): JsonResponse
    {
        $update = $this->productRepository->update($product->id, $request->validated());
        return ExitManagement::ok($update);
    }


    /**
     * @param Product $product
     * @return JsonResponse
     */
    public function destroy(Product $product): JsonResponse
    {
        return ExitManagement::ok($product->delete());
    }
}
