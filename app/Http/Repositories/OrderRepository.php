<?php

namespace App\Http\Repositories;


use App\Models\Order;
use Illuminate\Database\Eloquent\Model;


/**
 *
 */
class OrderRepository extends Repository
{
    /**
     * @var Model|Order
     */
    public Model|Order $model;

    /**
     *
     */
    public function __construct()
    {
        $this->model = new Order();
        parent::__construct($this->model);
    }
}
