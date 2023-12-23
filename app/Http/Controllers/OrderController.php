<?php

namespace App\Http\Controllers;

use App\Http\Managements\ExitManagement;
use App\Http\Repositories\OrderRepository;
use App\Http\Requests\StoreOrderRequest;
use App\Http\Requests\UpdateOrderRequest;
use App\Http\Resources\OrderCollection;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use Illuminate\Http\JsonResponse;
use Illuminate\Validation\ValidationException;

class OrderController extends Controller
{
    /**
     * @var OrderRepository
     */
    public OrderRepository $orderRepository;


    /**
     *
     */
    public function __construct()
    {
        $this->orderRepository = new OrderRepository();
    }


    /**
     * @return JsonResponse
     */
    public function index(): JsonResponse
    {
        return ExitManagement::ok(OrderCollection::collection($this->orderRepository->all()));
    }


    public function store(StoreOrderRequest $request)
    {
        $order = Order::where('user_id', request()->header('X-USER-ID'))->where('status', 1)->first();

        if (!$order) {
            $product = Product::find($request->product_id);

            if ($product->is_daily) {

                if (!$request->has('daily_at')) {
                    throw ValidationException::withMessages([
                        'daily_at' => ['Randevu tarihini girmelisiniz !'],
                    ]);
                }

                $daily_count = OrderItem::where('product_id', $request->product_id)->whereDate("daily_at", $request->daily_at)->count();

                $checkStock = $product->stock >= $daily_count;


                if (!$checkStock) {
                    throw ValidationException::withMessages([
                        'product_id' => ['Gun icerisinde randevu saati kalmamistir !'],
                    ]);
                }
                if ($checkStock) {

                    $order = Order::create([
                        'user_id' => request()->header('X-USER-ID'),
                        'code' => uniqid(),
                        'status' => 1
                    ]);
                    $order->items()->create($request->validated() + ['price' => $product->price]);
                    return $order;
                }
            } else {
                $checkStock = $product->stock >= $request->quantity;
                if (!$checkStock) {
                    throw ValidationException::withMessages([
                        'product_id' => ['Urun tukenmistir !'],
                    ]);
                }
                $order = Order::create([
                    'user_id' => request()->header('X-USER-ID'),
                    'code' => uniqid(),
                    'status' => 1
                ]);

                $order->items()->create([
                    'price' => $product->price,
                    'product_id' => $request->product_id,
                    'quantity' => $request->quantity
                ]);
                $product->decrement('stock', $request->quantity);
                return $order;
            }


        }


        if (collect($order->items)->where('product_id', $request->product_id)->values()->first()) {
            throw ValidationException::withMessages([
                'product_id' => ['Urun sepet icinde tanimlidir !'],
            ]);
        }





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
