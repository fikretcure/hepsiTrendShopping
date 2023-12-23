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


    public function whereProductWhereDailyAt($product_id, $daily_at)
    {
        return $this->model->where('product_id', $product_id)->whereDate("daily_at", $daily_at)->count();

    }
}
