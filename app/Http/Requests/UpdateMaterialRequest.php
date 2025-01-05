<?php

namespace App\Http\Requests;

use App\DTO\MaterialDTO;
use App\Interfaces\SwaggerRequest;
use Illuminate\Foundation\Http\FormRequest;

class UpdateMaterialRequest extends FormRequest implements SwaggerRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'category_id' => ['required', 'exists:categories,id'],
            'name' => ['required', 'string', 'max:255'],
            'description' => 'string|nullable',
            'price' => ['required', 'decimal:0,2', 'min:0'],
        ];
    }

    public function examples(): array
    {
        return [
            'category_id' => 1,
            'name' => 'Name',
            'description' => 'Description',
            'price' => 15.0,
        ];
    }

    public function toDto(): MaterialDTO
    {
        return new MaterialDTO(
            $this->input('name'),
            $this->input('category_id'),
            $this->input('description'),
            (float) $this->input('price'),
        );
    }
}
