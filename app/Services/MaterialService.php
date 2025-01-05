<?php

namespace App\Services;

use App\DTO\CategoryDTO;
use App\DTO\MaterialDTO;
use App\Exceptions\BadRequestException;
use App\Models\Category;
use App\Models\Material;
use App\Models\Product;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Model;
use Spatie\QueryBuilder\AllowedFilter;
use Spatie\QueryBuilder\QueryBuilder;

class MaterialService
{
    public function create(MaterialDTO $materialDTO, int $userId): Model
    {
        if (
            Material::where('name', $materialDTO->name)
                ->where('user_id', $userId)
                ->where('category_id', $materialDTO->categoryId)
                ->exists()
        ) {
            throw new BadRequestException('Category already exists');
        }

        return Material::create([
            'user_id' => $userId,
            'name' => $materialDTO->name,
            'category_id' => $materialDTO->categoryId,
            'description' => $materialDTO->description,
            'price' => $materialDTO->price,
        ]);
    }

    public function list(array $request, int $userId): LengthAwarePaginator
    {
        $query = QueryBuilder::for(Material::query())
            ->select(['*'])
            ->allowedFilters([
                'name',
                AllowedFilter::exact('category_id'),
            ])
            ->where('user_id', $userId)
            ->with('category');

        return $query->paginate($request['per_page'] ?? 30);
    }

    public function update(MaterialDTO $materialDTO, Material $material)
    {
        $material->update([
            'category_id' => $materialDTO->categoryId,
            'name' => $materialDTO->name,
            'description' => $materialDTO->description,
            'price' => $materialDTO->price,
        ]);

        return $material;
    }
}
