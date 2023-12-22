<?php

namespace App\Http\Repositories;


use App\Models\Product;
use Illuminate\Database\Eloquent\Model;


/**
 *
 */
class ProductRepository extends Repository
{
    /**
     * @var Model|Product
     */
    public Model|Product $model;

    /**
     *
     */
    public function __construct()
    {
        $this->model = new Product();
        parent::__construct($this->model);
    }
}
