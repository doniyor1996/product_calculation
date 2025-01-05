<?php

namespace App\Services;

use App\Enums\CategoryTypesEnum;
use App\Exceptions\BadRequestException;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Spatie\QueryBuilder\AllowedFilter;
use Spatie\QueryBuilder\QueryBuilder;

class ProductService
{
    public function create(array $data, int $userId)
    {
        if (! $this->validateCategory($data['category_id'], $userId)) {
            throw new BadRequestException(
                'Invalid category or category not found.',
            );
        }

        return Product::create($data + [
            'user_id' => $userId,
        ]);
    }

    public function update(Product $product, array $data): Product
    {
        if (! $this->validateCategory($data['category_id'], $product->user_id)) {
            throw new BadRequestException(
                'Invalid category or category not found.',
            );
        }

        $product->update($data);

        $product->load('category');

        return $product;
    }

    public function list(array $request, int $userId): LengthAwarePaginator
    {
        $query = QueryBuilder::for(Product::query())
            ->select(['*'])
            ->allowedFilters([
                'name',
                AllowedFilter::exact('category_id'),
            ])
            ->where('user_id', $userId)
            ->with('category');

        return $query->paginate($request['per_page'] ?? 30);
    }

    private function validateCategory(int $categoryId, int $userId): bool
    {
        return Category::where('user_id', $userId)
            ->where('id', $categoryId)
            ->where('type', CategoryTypesEnum::PRODUCT->value)
            ->exists();
    }
}
