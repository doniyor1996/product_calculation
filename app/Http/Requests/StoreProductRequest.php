<?php

namespace App\Http\Requests;

use App\Interfaces\SwaggerRequest;
use Illuminate\Foundation\Http\FormRequest;

class StoreProductRequest extends FormRequest
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
            'category_id' => 'required|exists:categories,id',
            'materials' => 'required|array',
            'materials.*.material_id' => 'required|exists:materials,id',
            'materials.*.quantity' => 'required|decimal:0,2',
        ];
    }
}
