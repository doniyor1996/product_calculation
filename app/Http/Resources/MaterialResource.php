<?php

namespace App\Http\Resources;

use App\Helpers\ConstantsHelper;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class MaterialResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'category_id' => $this->category_id,
            'category_name' => $this->category->name,
            'name' => $this->name,
            'description' => $this->description,
            'price' => $this->price,
            'created_at' => $this->created_at->format(ConstantsHelper::DATE_FORMAT),
            'updated_at' => $this->updated_at->format(ConstantsHelper::DATE_FORMAT),
        ];
    }
}
