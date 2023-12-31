<?php

namespace App\Http\Controllers;

use App\Enums\OrderStatusEnum;
use App\Http\Managements\CategoryManagement;
use App\Http\Managements\ExitManagement;
use App\Http\Managements\OrderManagement;
use App\Http\Repositories\OrderItemRepository;
use App\Http\Repositories\OrderRepository;
use App\Http\Repositories\ProductRepository;
use App\Http\Requests\OrderChangeSuccessRequest;
use App\Http\Requests\OrderPaymentRequest;
use App\Http\Requests\StoreOrderRequest;
use App\Http\Resources\OrderCollection;
use App\Http\Resources\OrderItemCollection;
use App\Http\Services\GatewayService;
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
     * @var GatewayService
     */
    public GatewayService $gatewayService;

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
        $this->gatewayService = new GatewayService();
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
     * @param $id
     * @return JsonResponse
     */
    public function show($id): JsonResponse
    {
        return ExitManagement::ok(OrderCollection::make($this->orderRepository->show($id)));
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
     * @param OrderPaymentRequest $request
     * @return JsonResponse
     * @throws ValidationException
     */
    public function payment(OrderPaymentRequest $request): JsonResponse
    {
        $order = $this->orderRepository->whereUserWhereStatusBasket();

        if ($order && isset($order->items)) {
            $request->merge([
                'order_id' => $order->id,
                'money' => $this->orderManagement->calculateBasket($order->items)
            ]);
            $this->orderManagement->payment();
            $this->orderRepository->update($order->id, [
                'is_payment' => true,
                'status' => OrderStatusEnum::PROCESSING->value,
            ]);

            $this->productRepository->decrementStock($order->items);
            return ExitManagement::ok($order);
        }
        throw ValidationException::withMessages([
            'basket' => ['Siparisinizi kontrol etmelisiniz !'],
        ]);
    }

    /**
     * @param OrderChangeSuccessRequest $request
     * @param $id
     * @return JsonResponse
     * @throws ValidationException
     */
    public function changeSuccesful(OrderChangeSuccessRequest $request, $id): JsonResponse
    {
        $order = $this->orderRepository->checkHasItem($id);
        $this->orderItemRepository->update($id, [
            "is_successful" => $request->status
        ]);

        $item = $this->orderItemRepository->find($id);
        $request->merge([
            'order_id' => $order->id,
            'item' => $item,
            'product' => $this->productRepository->find($item->id)
        ]);
        if ($request->status) {
            $this->gatewayService->send('post', 'api/invoices', null);
        } else {
            $this->gatewayService->send('post', 'api/failed-service', null);
        }
        return ExitManagement::ok();
    }
}
