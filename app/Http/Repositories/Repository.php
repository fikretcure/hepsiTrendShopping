<?php

namespace App\Http\Repositories;

use Illuminate\Database\Eloquent\Collection;
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
     * @return Collection
     */
    public function all()
    {
        return $this->model->all();
    }

    /**
     * @return mixed
     */
    public function get()
    {
        return $this->model->get();
    }

    /**
     * @param $id
     * @return mixed
     */
    public function find($id)
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
    public function create(array $data = null)
    {
        return $this->model->create($data);
    }

    /**
     * @param int $id
     * @param array|null $data
     * @return mixed
     */
    public function update(int $id, array $data = null)
    {
        return $this->model->whereId($id)->update($data);
    }
}
