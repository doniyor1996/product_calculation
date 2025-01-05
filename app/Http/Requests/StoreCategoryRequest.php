<?php

namespace App\Http\Requests;

use App\DTO\CategoryDTO;
use App\Enums\CategoryTypesEnum;
use App\Interfaces\SwaggerRequest;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreCategoryRequest extends FormRequest implements SwaggerRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'max:255'],
            'type' => ['required', Rule::enum(CategoryTypesEnum::class)],
        ];
    }

    public function examples(): array
    {
        return [
            'name' => 'Category name',
            'type' => 'product',
        ];
    }

    public function toDto(): CategoryDTO
    {
        return new CategoryDTO(
            name: $this->input('name'),
            type: $this->input('type'),
        );
    }
}
