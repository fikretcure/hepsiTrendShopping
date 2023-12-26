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
            'price' => $this->price,
            'stock' => $this->stock,
            'desc' => $this->desc,
            'avatar' => $this->avatar,
            'category' => CategoryExtendCollection::make($this->category),
        ];
    }
}
