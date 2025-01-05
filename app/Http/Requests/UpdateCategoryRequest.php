<?php

namespace App\Http\Requests;

use App\Interfaces\SwaggerRequest;
use Illuminate\Foundation\Http\FormRequest;

class UpdateCategoryRequest extends FormRequest implements SwaggerRequest
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
            'name' => ['required', 'string', 'max:255'],
        ];
    }

    public function examples(): array
    {
        return [
            'name' => 'Category name',
        ];
    }
}
