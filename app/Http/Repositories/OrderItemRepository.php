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
     * @param $increment
     * @return mixed
     */
    public function incrementQuantityWhereOrderWhereProduct($order_id, $product_id, $increment): mixed
    {
        return $this->model->where('order_id', $order_id)->where('product_id', $product_id)->increment('quantity', $increment);
    }
}
