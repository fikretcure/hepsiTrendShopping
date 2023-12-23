<?php

namespace App\Http\Managements;

use App\Http\Repositories\OrderItemRepository;
use App\Http\Repositories\OrderRepository;
use App\Models\Product;
use Illuminate\Validation\ValidationException;

/**
 *
 */
class CategoryManagement
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
     *
     */
    public function __construct()
    {
        $this->orderItemRepository = new OrderItemRepository();
        $this->orderRepository = new OrderRepository();
    }


    /**
     * @return mixed
     */
    public function createOrder(): mixed
    {
        return $this->orderRepository->create([
            'user_id' => request()->header('X-USER-ID'),
            'code' => uniqid(),
            'status' => 1
        ]);
    }


    public function isNotOrder($product, $request)
    {
        if ($product->is_daily) {

            if (!$request->has('daily_at')) {
                throw ValidationException::withMessages([
                    'daily_at' => ['Randevu tarihini girmelisiniz !'],
                ]);
            }

            $daily_count = $this->orderItemRepository->whereProductWhereDailyAt($request->product_id, $request->daily_at);

            $checkStock = $product->stock >= $daily_count;


            if (!$checkStock) {
                throw ValidationException::withMessages([
                    'product_id' => ['Gun icerisinde randevu saati kalmamistir !'],
                ]);
            }
            if ($checkStock) {
                $order = $this->createOrder();
                $order->items()->create($request->validated() + ['price' => $product->price]);
                return $order;
            }
        }
        $checkStock = $product->stock >= $request->quantity;
        if (!$checkStock) {
            throw ValidationException::withMessages([
                'product_id' => ['Urun tukenmistir !'],
            ]);
        }
        $order = $this->createOrder();

        $order->items()->create([
            'price' => $product->price,
            'product_id' => $request->product_id,
            'quantity' => $request->quantity
        ]);
        $product->decrement('stock', $request->quantity);
        return $order;
    }


    public function isOrder($order, $product, $request)
    {
        if (collect($order->items)->where('product_id', $request->product_id)->values()->first()) {
            throw ValidationException::withMessages([
                'product_id' => ['Urunu sepet icinde tekrar tanimlayamazsiniz !'],
            ]);
        }


        if ($product->is_daily != Product::find(collect($order->items)->first()->product_id)->is_daily) {
            throw ValidationException::withMessages([
                'product_id' => ['Randevulu ve randevusuz urunleri ayni sepette tanimlayamazsiniz !'],
            ]);
        }



        if ($product->is_daily) {

            if (!$request->has('daily_at')) {
                throw ValidationException::withMessages([
                    'daily_at' => ['Randevu tarihini girmelisiniz !'],
                ]);
            }

            $daily_count = $this->orderItemRepository->whereProductWhereDailyAt($request->product_id, $request->daily_at);

            $checkStock = $product->stock >= $daily_count;


            if (!$checkStock) {
                throw ValidationException::withMessages([
                    'product_id' => ['Gun icerisinde randevu saati kalmamistir !'],
                ]);
            }
            if ($checkStock) {
                $order->items()->create($request->validated() + ['price' => $product->price]);
                return $order;
            }
        }

        return 11;

    }

    public function generateOrder($order, $product, $request)
    {
        if (!$order) {
            return $this->isNotOrder($product, $request);
        }


        return $this->isOrder($order, $product, $request);
    }

}
