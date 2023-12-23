<?php

namespace App\Http\Controllers;

use App\Http\Managements\CategoryManagement;
use App\Http\Managements\ExitManagement;
use App\Http\Managements\OrderManagement;
use App\Http\Repositories\OrderRepository;
use App\Http\Repositories\ProductRepository;
use App\Http\Requests\StoreOrderRequest;
use App\Http\Requests\UpdateOrderRequest;
use App\Http\Resources\OrderCollection;
use App\Models\Order;
use Illuminate\Http\JsonResponse;
use Illuminate\Validation\ValidationException;

class OrderController extends Controller
{
    /**
     * @var OrderRepository
     */
    public OrderRepository $orderRepository;


    /**
     * @var ProductRepository
     */
    public ProductRepository $productRepository;


    /**
     * @var CategoryManagement
     */
    public CategoryManagement $categoryManagement;


    /**
     * @var OrderManagement
     */
    public OrderManagement $orderManagement;


    /**
     *
     */
    public function __construct()
    {
        $this->orderRepository = new OrderRepository();
        $this->productRepository = new ProductRepository();
        $this->categoryManagement = new CategoryManagement();
        $this->orderManagement = new OrderManagement();
    }


    /**
     * @return JsonResponse
     */
    public function index(): JsonResponse
    {
        return ExitManagement::ok(OrderCollection::collection($this->orderRepository->all()));
    }


    /**
     * @param StoreOrderRequest $request
     * @return mixed
     * @throws ValidationException
     */
    public function store(StoreOrderRequest $request): mixed
    {
        $order = $this->orderRepository->whereUserWhereStatusBasket();
        $product = $this->productRepository->find($request->product_id);
        $order = $this->orderManagement->generateOrder($order, $product, $request);
        return ExitManagement::ok(OrderCollection::make($order));
    }

    /**
     * Display the specified resource.
     */
    public function show(Order $order)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateOrderRequest $request, Order $order)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Order $order)
    {
        //
    }
}
