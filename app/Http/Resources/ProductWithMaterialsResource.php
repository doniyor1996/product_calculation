<?php

namespace App\Http\Resources;

use App\Helpers\ConstantsHelper;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ProductWithMaterialsResource extends ProductResource
{
    public function toArray(Request $request): array
    {
        return array_merge(parent::toArray($request), [
            'materials' => $this->materials->toArray(),
        ]);
    }
}
