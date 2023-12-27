<?php

namespace App\Http\Managements;

use App\Enums\OrderStatusEnum;
use App\Http\Repositories\OrderItemRepository;
use App\Http\Repositories\OrderRepository;
use App\Http\Repositories\ProductRepository;
use App\Http\Services\GatewayService;
use Illuminate\Validation\ValidationException;

/**
 *
 */
class OrderManagement
{

    /**
     * @var OrderItemRepository
     */
    public OrderItemRepository $orderItemRepository;


    /**
     * @var OrderRepository
     */
    public OrderRepository $orderRepository;


    /**
     * @var ProductManagement
     */
    public ProductManagement $productManagement;


    /**
     * @var ProductRepository
     */
    public ProductRepository $productRepository;

    /**
     * @var GatewayService
     */
    public GatewayService $gatewayService;

    /**
     *
     */
    public function __construct()
    {
        $this->orderItemRepository = new OrderItemRepository();
        $this->orderRepository = new OrderRepository();
        $this->productManagement = new ProductManagement();
        $this->productRepository = new ProductRepository();
        $this->gatewayService = new GatewayService();
    }


    /**
     * @param $data
     * @return mixed
     */
    public function createOrder($data): mixed
    {
        $order = $this->orderRepository->create([
            'user_id' => request()->header('X-USER-ID'),
            'code' => uniqid(),
            'status' => OrderStatusEnum::IN_BASKET->value
        ]);
        $order->items()->create($data);
        return $order;
    }


    /**
     * @param $product
     * @param $quantity
     * @return void
     * @throws ValidationException
     */
    public function checkProductStock($product, $quantity): void
    {
        if (!($product->stock >= $quantity)) {
            throw ValidationException::withMessages([
                'product_id' => ['Urun tukenmistir !'],
            ]);
        }
    }


    /**
     * @param $product
     * @param $request
     * @return mixed
     * @throws ValidationException
     */
    public function isNotOrder($product, $request): mixed
    {
        $this->checkProductStock($product, $request->quantity);
        $order = $this->createOrder($request->validated() + ['price' => $product->price]);
        return $order;
    }


    /**
     * @param $order
     * @param $data
     * @return void
     */
    public function storeOrderItems($order, $data): void
    {
        $order->items()->create($data);
    }


    /**
     * @param $order
     * @param $product
     * @param $request
     * @return mixed
     * @throws ValidationException
     */
    public function isOrder($order, $product, $request): mixed
    {
        if (collect($order->items)->where('product_id', $request->product_id)->values()->first()) {
            throw ValidationException::withMessages([
                'product_id' => ['Urunu sepet icinde tekrar tanimlayamazsiniz !'],
            ]);
        }
        $this->checkProductStock($product, $request->quantity);
        $this->storeOrderItems($order, $request->validated() + ['price' => $product->price]);
        return $order;
    }


    /**
     * @param $order
     * @param $product
     * @param $request
     * @return mixed
     * @throws ValidationException
     */
    public function generateOrder($order, $product, $request): mixed
    {
        if (!$order) {
            return $this->isNotOrder($product, $request);
        }
        return $this->isOrder($order, $product, $request);
    }


    /**
     * @param $order
     * @param $product
     * @return void
     * @throws ValidationException
     */
    public function incrementQuantityProduct($order, $product): void
    {
        $this->checkProductStock($product, 1);
        $this->orderItemRepository->incrementQuantityWhereOrderWhereProduct($order->id, $product->id);
    }

    /**
     * @param $order
     * @param $product
     * @return void
     */
    public function decrementQuantityProduct($order, $product): void
    {
        $this->orderItemRepository->decrementQuantityWhereOrderWhereProduct($order->id, $product->id);
    }

    /**
     * @param $order
     * @param $product
     * @return void
     */
    public function removeProduct($order, $product): void
    {
        $this->orderItemRepository->removeProduct($order->id, $product->id);
    }


    /**
     * @param $request
     * @return array
     * @throws ValidationException
     */
    public function checkOrderAndProduct($request): array
    {
        $order = $this->orderRepository->whereUserWhereStatusBasket();
        if (!($order && $this->orderItemRepository->whereOrderWhereProductExists($order->id, $request->product_id))) {
            throw ValidationException::withMessages([
                'product_id' => ['Urunu sepete eklemeniz gerekiyor !'],
            ]);
        }
        $product = $this->productRepository->find($request->product_id);

        return [
            'order' => $order,
            'product' => $product,
        ];
    }


    /**
     * @param $orderItems
     * @return float|int
     */
    public function calculateBasket($orderItems): float|int
    {
        $money = 0;
        $orderItems->each(function ($item, $key) use (&$money) {
            $money += $item->price * $item->quantity;
        });
        return $money;
    }

    /**
     * @return void
     * @throws ValidationException
     */
    public function payment(): void
    {
        $gateway = $this->gatewayService->send(method: 'post', path: 'api/payment', file_path: null);

        if (!$gateway->original['data']['status']) {
            throw ValidationException::withMessages([
                'card_no' => ['Odeme basarisiz'],
            ]);
        }
    }
}
