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
        return $this->model->where('order_id', $order_id)->where('product_id', $product_id)->increment('quantity');
    }


    /**
     * @param $order_id
     * @param $product_id
     * @return mixed
     */
    public function decrementQuantityWhereOrderWhereProduct($order_id, $product_id): mixed
    {
        $data = $this->model->where('order_id', $order_id)->where('product_id', $product_id)->first();
        if ($data->quantity == 1) {
            return $data->delete();
        }
        return $this->model->where('order_id', $order_id)->where('product_id', $product_id)->decrement('quantity');
    }


    /**
     * @param $order_id
     * @param $product_id
     * @return mixed
     */
    public function whereOrderWhereProduct($order_id, $product_id): mixed
    {
        return $this->model->where('order_id', $order_id)->where('product_id', $product_id)->exists();
    }


    /**
     * @param $order_id
     * @param $product_id
     * @return mixed
     */
    public function removeProduct($order_id, $product_id): mixed
    {
        return $this->model->where('order_id', $order_id)->where('product_id', $product_id)->delete();
    }
}
