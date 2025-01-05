<?php

namespace App\Services;

use App\DTO\CategoryDTO;
use App\Exceptions\BadRequestException;
use App\Models\Category;
use Illuminate\Database\Eloquent\Model;

class CategoryService
{
    public function create(CategoryDTO $categoryDTO, int $userId): Model
    {
        $category = Category::withTrashed()
            ->where('name', $categoryDTO->name)
            ->where('user_id', $userId)
            ->where('type', $categoryDTO->type)
            ->first();

        if ($category->deleted_at) {
            $category->restore();
            return $category;
        } elseif ($category) {
            throw new BadRequestException('Category already exists');
        }

        return Category::create([
            'user_id' => $userId,
            'type' => $categoryDTO->type,
            'name' => $categoryDTO->name,
        ]);
    }
}
