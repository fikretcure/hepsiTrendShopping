<?php

namespace App\Http\Controllers;

use App\Http\Managements\CategoryManagement;
use App\Http\Managements\ExitManagement;
use App\Http\Repositories\CategoryRepository;
use App\Http\Requests\StoreCategoryRequest;
use App\Http\Requests\UpdateCategoryRequest;
use App\Http\Resources\CategoryCollection;
use App\Models\Category;
use Illuminate\Http\JsonResponse;
use Illuminate\Validation\ValidationException;

/**
 *
 */
class CategoryController extends Controller
{

    /**
     * @var CategoryRepository
     */
    public CategoryRepository $categoryRepository;

    /**
     * @var CategoryManagement
     */
    public CategoryManagement $categoryManagement;


    /**
     *
     */
    public function __construct()
    {
        $this->categoryRepository = new CategoryRepository();
        $this->categoryManagement = new CategoryManagement();
    }


    /**
     * @return JsonResponse
     */
    public function index(): JsonResponse
    {
        return ExitManagement::ok(CategoryCollection::collection($this->categoryRepository->all()));
    }


    /**
     * @param StoreCategoryRequest $request
     * @return JsonResponse
     */
    public function store(StoreCategoryRequest $request): JsonResponse
    {
        $store = $this->categoryRepository->create($request->validated());
        return ExitManagement::ok(CategoryCollection::make($store));
    }


    /**
     * @param Category $category
     * @return JsonResponse
     */
    public function show(Category $category): JsonResponse
    {
        return ExitManagement::ok(CategoryCollection::make($category));
    }


    /**
     * @param UpdateCategoryRequest $request
     * @param Category $category
     * @return JsonResponse
     */
    public function update(UpdateCategoryRequest $request, Category $category): JsonResponse
    {
        $update = $this->categoryRepository->update($category->id, $request->validated());
        return ExitManagement::ok($update);
    }


    /**
     * @param Category $category
     * @return JsonResponse
     * @throws ValidationException
     */
    public function destroy(Category $category): JsonResponse
    {
        $this->categoryManagement->checkUsageProduct($category);
        return ExitManagement::ok($category->delete());
    }
}
