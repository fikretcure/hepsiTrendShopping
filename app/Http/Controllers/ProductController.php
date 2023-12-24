<?php

namespace App\Http\Controllers;

use App\Http\Managements\ExitManagement;
use App\Http\Managements\ProductManagement;
use App\Http\Repositories\ProductRepository;
use App\Http\Requests\StoreProductRequest;
use App\Http\Requests\UpdateProductRequest;
use App\Http\Resources\ProductCollection;
use App\Models\Product;
use Illuminate\Http\JsonResponse;
use Illuminate\Validation\ValidationException;

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
     * @var ProductManagement
     */
    public ProductManagement $productManagement;

    /**
     *
     */
    public function __construct()
    {
        $this->productRepository = new ProductRepository();
        $this->productManagement = new ProductManagement();
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
     * @throws ValidationException
     */
    public function store(StoreProductRequest $request): JsonResponse
    {
        $this->productManagement->checkImageType($request);
        $store = $this->productRepository->create($request->validated());
        $this->productManagement->moveFile($request);
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
     * @throws ValidationException
     */
    public function update(UpdateProductRequest $request, Product $product): JsonResponse
    {
        $this->productManagement->checkImageType($request);
        $update = $this->productRepository->update($product->id, $request->validated());
        $this->productManagement->moveFile($request);
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
