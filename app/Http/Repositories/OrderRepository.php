<?php

namespace App\Http\Repositories;


use App\Enums\OrderStatusEnum;
use App\Models\Order;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Validation\ValidationException;


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


    /**
     * @return Collection
     */
    public function all(): Collection
    {
        return $this->model->where('status', '!=', 1)->get();
    }


    /**
     * @return mixed
     */
    public function whereUserWhereStatusBasket(): mixed
    {
        return $this->model->where('user_id', request()->header('X-USER-ID'))->where('status', 1)->first();
    }


    /**
     * @return mixed
     */
    public function whereUserWhereStatusBasketAll(): mixed
    {
        $data = $this->model->where('user_id', request()->header('X-USER-ID'))->where('status', 1)->first();
        return $data->items ?? [];
    }


    /**
     * @param $id
     * @return mixed
     * @throws ValidationException
     */
    public function checkHasItem($id): mixed
    {
        $data = $this->model
            ->where('user_id', request()->header('X-USER-ID'))
            ->where('is_payment', true)
            ->where('status', OrderStatusEnum::PROCESSING->value)
            ->whereHas('items', function (Builder $query) use ($id) {
                $query->where('id', $id);
                $query->whereNull('is_successful');
            })
            ->first();

        if (!$data) {
            throw ValidationException::withMessages([
                'id' => ['Lutfen destege basvurunuz !'],
            ]);
        }
        return $data;
    }
}
