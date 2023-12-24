<?php

namespace App\Http\Controllers;

use App\Http\Managements\CategoryManagement;
use App\Http\Managements\ExitManagement;
use App\Http\Managements\OrderManagement;
use App\Http\Repositories\OrderItemRepository;
use App\Http\Repositories\OrderRepository;
use App\Http\Repositories\ProductRepository;
use App\Http\Requests\StoreOrderRequest;
use App\Http\Resources\OrderCollection;
use App\Http\Resources\OrderItemCollection;
use App\Models\Order;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

/**
 *
 */
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
     * @var OrderItemRepository
     */
    public OrderItemRepository $orderItemRepository;

    /**
     *
     */
    public function __construct()
    {
        $this->orderRepository = new OrderRepository();
        $this->productRepository = new ProductRepository();
        $this->categoryManagement = new CategoryManagement();
        $this->orderManagement = new OrderManagement();
        $this->orderItemRepository = new OrderItemRepository();
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
        $this->orderManagement->generateOrder($order, $product, $request);
        return ExitManagement::ok(OrderItemCollection::collection($this->orderRepository->whereUserWhereStatusBasketAll()));
    }

    /**
     * Display the specified resource.
     */
    public function show(Order $order)
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


    /**
     * @return JsonResponse
     */
    public function basket(): JsonResponse
    {
        return ExitManagement::ok(OrderItemCollection::collection($this->orderRepository->whereUserWhereStatusBasketAll()));
    }


    /**
     * @param Request $request
     * @return JsonResponse
     * @throws ValidationException
     */
    public function increasingQuantityProduct(Request $request): JsonResponse
    {
        $data = $this->orderManagement->checkOrderAndProduct($request);
        $this->orderManagement->incrementQuantityProduct($data['order'], $data['product']);
        return ExitManagement::ok(OrderItemCollection::collection($this->orderRepository->whereUserWhereStatusBasketAll()));
    }

    /**
     * @param Request $request
     * @return JsonResponse
     * @throws ValidationException
     */
    public function decrementQuantityProduct(Request $request): JsonResponse
    {
        $data = $this->orderManagement->checkOrderAndProduct($request);
        $this->orderManagement->decrementQuantityProduct($data['order'], $data['product']);
        return ExitManagement::ok(OrderItemCollection::collection($this->orderRepository->whereUserWhereStatusBasketAll()));
    }

    /**
     * @param Request $request
     * @return JsonResponse
     * @throws ValidationException
     */
    public function removeProduct(Request $request): JsonResponse
    {
        $data = $this->orderManagement->checkOrderAndProduct($request);
        $this->orderManagement->removeProduct($data['order'], $data['product']);
        return ExitManagement::ok(OrderItemCollection::collection($this->orderRepository->whereUserWhereStatusBasketAll()));
    }

    /**
     * @return JsonResponse
     */
    public function orderId(): JsonResponse
    {
        $order = $this->orderRepository->whereUserWhereStatusBasket();
        return ExitManagement::ok([
            'order_id' => $order->id,
            'money' => $this->orderManagement->calculateBasket($order->items)
        ]);
    }

}
