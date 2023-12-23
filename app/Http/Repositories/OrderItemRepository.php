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
}
