<?php

namespace App\Http\Resources;

use App\Helpers\ConstantsHelper;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CategoryResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'type' => $this->type,
            'created_at' => $this->created_at->format(ConstantsHelper::DATE_FORMAT),
            'updated_at' => $this->updated_at->format(ConstantsHelper::DATE_FORMAT),
        ];
    }
}
