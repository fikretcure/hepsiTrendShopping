<?php

namespace App\Http\Repositories;


use App\Models\Category;
use Illuminate\Database\Eloquent\Model;


/**
 *
 */
class CategoryRepository extends Repository
{
    /**
     * @var Model|Category
     */
    public Model|Category $model;

    /**
     *
     */
    public function __construct()
    {
        $this->model = new Category();
        parent::__construct($this->model);
    }
}
