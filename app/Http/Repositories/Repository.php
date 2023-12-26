<?php

namespace App\Http\Repositories;

use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Model;

/**
 *
 */
class Repository
{
    /**
     * @var Model
     */
    public Model $model;

    /**
     * @param Model $model
     */
    public function __construct(Model $model)
    {
        $this->model = $model;
    }

    /**
     * @return LengthAwarePaginator
     */
    public function all(): LengthAwarePaginator
    {
        return $this->model->query()->paginate();
    }

    /**
     * @return mixed
     */
    public function get(): mixed
    {
        return $this->model->get();
    }

    /**
     * @param $id
     * @return mixed
     */
    public function find($id): mixed
    {
        return $this->model->findOrFail($id);
    }

    /**
     * @param $id
     * @return mixed
     */
    public function delete($id): mixed
    {
        return $this->model->findOrFail($id)->delete();
    }

    /**
     * @param array|null $data
     * @return mixed
     */
    public function create(array $data = null): mixed
    {
        return $this->model->create($data);
    }

    /**
     * @param int $id
     * @param array|null $data
     * @return mixed
     */
    public function update($id, array $data = null): mixed
    {
        return $this->model->whereId($id)->update($data);
    }
}
