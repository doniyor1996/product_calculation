<?php

namespace App\Http\Resources;

use App\Helpers\ConstantsHelper;
use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'email' => $this->email,
            'created_at' => $this->created_at->format(ConstantsHelper::DATE_FORMAT),
            'updated_at' => $this->updated_at->format(ConstantsHelper::DATE_FORMAT),
        ];
    }
}
