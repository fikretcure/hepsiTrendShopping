<?php

namespace App\Http\Repositories;


use App\Models\OrderItem;
use Illuminate\Database\Eloquent\Model;


/**
 *
 */
class OrderItemRepository extends Repository
{
    /**
     * @var Model|OrderItem
     */
    public Model|OrderItem $model;

    /**
     *
     */
    public function __construct()
    {
        $this->model = new OrderItem();
        parent::__construct($this->model);
    }


    /**
     * @param $order_id
     * @param $product_id
     * @return mixed
     */
    public function incrementQuantityWhereOrderWhereProduct($order_id, $product_id): mixed
    {
        return $this->whereOrderWhereProduct($order_id, $product_id)->increment('quantity');
    }


    /**
     * @param $order_id
     * @param $product_id
     * @return mixed
     */
    public function decrementQuantityWhereOrderWhereProduct($order_id, $product_id): mixed
    {
        $orderItem = $this->whereOrderWhereProduct($order_id, $product_id)->first();
        if ($orderItem->quantity == 1) {
            return $orderItem->delete();
        }
        return $orderItem->decrement('quantity');
    }


    /**
     * @param $order_id
     * @param $product_id
     * @return mixed
     */
    public function whereOrderWhereProductExists($order_id, $product_id): mixed
    {
        return $this->whereOrderWhereProduct($order_id, $product_id)->exists();
    }


    /**
     * @param $order_id
     * @param $product_id
     * @return mixed
     */
    public function removeProduct($order_id, $product_id): mixed
    {
        return $this->whereOrderWhereProduct($order_id, $product_id)->delete();
    }


    /**
     * @param int $order_id
     * @param int $product_id
     * @return mixed
     */
    public function whereOrderWhereProduct(int $order_id, int $product_id): mixed
    {
        return $this->model->where('order_id', $order_id)->where('product_id', $product_id);
    }
}
