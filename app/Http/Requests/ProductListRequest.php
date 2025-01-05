<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductListRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'page' => 'integer|required',
            'per_page' => 'integer',
            'filter' => 'array',
        ];
    }
}
