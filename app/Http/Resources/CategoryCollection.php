<?php

namespace App\Http\Resources;

use App\Http\Resources\Extends\CategoryExtendCollection;
use App\Http\Resources\Extends\ProductExtendCollection;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CategoryCollection extends JsonResource
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
            'products' => ProductExtendCollection::collection($this->products),
        ];
    }


}
