<?php

namespace App\Http\Resources;

use App\Helpers\ConstantsHelper;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ProductResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'description' => $this->description,
            'price' => $this->price,
            'cost' => $this->cost,
            'category_id' => $this->category_id,
            'category' => [
                'id' => $this->category->id,
                'name' => $this->category->name,
            ],
            'created_at' => $this->created_at->format(ConstantsHelper::DATE_FORMAT),
            'updated_at' => $this->updated_at->format(ConstantsHelper::DATE_FORMAT),
        ];
    }
}
