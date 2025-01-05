<?php

namespace App\Http\Requests;

use App\Interfaces\SwaggerRequest;
use Illuminate\Foundation\Http\FormRequest;

class StoreProductRequest extends FormRequest implements SwaggerRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => 'required',
            'description' => 'nullable|string|max:255',
            'price' => 'required|numeric',
            'cost' => 'required|numeric',
            'category_id' => 'required|exists:categories,id',
        ];
    }

    public function examples(): array
    {
        return [
            'name' => 'Мешалка',
            'description' => 'Описание',
            'price' => 15.0,
            'cost' => 2500.0,
            'category_id' => 1,
        ];
    }
}
