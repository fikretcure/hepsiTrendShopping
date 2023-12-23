<?php

namespace App\Http\Resources;

use App\Http\Resources\Extends\CategoryExtendCollection;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ProductCollection extends JsonResource
{
    /**
     * Transform the resource collection into an array.
     *
     * @return array<int|string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'expert_user' => collect($this->expert_user)->except('email'),
            'price' => $this->price,
            'daily_stock' => $this->daily_stock,
            'desc' => $this->desc,
            'avatar' => $this->avatar,
            'category' => CategoryExtendCollection::make($this->category),
        ];
    }


}
