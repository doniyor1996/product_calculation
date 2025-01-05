<?php

namespace App\Http\Controllers;

use App\Enums\CategoryTypesEnum;
use App\Http\Attributes\Models\CategorySchema;
use App\Http\Attributes\Parameters\PathParameter;
use App\Http\Attributes\Parameters\QueryParameter;
use App\Http\Attributes\Requests\RequestBody;
use App\Http\Attributes\Responses\EntityListResponse;
use App\Http\Attributes\Responses\EntityResponse;
use App\Http\Attributes\Responses\NoContentResponse;
use App\Http\Requests\CategoryListRequest;
use App\Http\Requests\StoreCategoryRequest;
use App\Http\Requests\UpdateCategoryRequest;
use App\Http\Resources\CategoryResource;
use App\Models\Category;
use App\Services\CategoryService;
use Illuminate\Http\JsonResponse;
use OpenApi\Attributes\Delete;
use OpenApi\Attributes\Get;
use OpenApi\Attributes\Post;
use OpenApi\Attributes\Put;

class CategoryController extends Controller
{
    public function __construct(
        protected CategoryService $service,
    ) {
        $this->authorizeResource(Category::class, 'category');
    }

    #[
        Get(
            path: '/api/categories',
            operationId: 'categories-list-get',
            summary: 'Get categories',
            security: [
                ['bearer' => []],
            ],
            tags: ['Categories'],
            parameters: [
                new QueryParameter('type', CategoryTypesEnum::MATERIAL->value),
            ],
            responses: [
                new EntityListResponse(CategorySchema::class),
            ],
        )
    ]
    public function index(CategoryListRequest $request): JsonResponse
    {
        return $this->responseSuccess(CategoryResource::collection(
            Category::where('user_id', request()->user()->id)
                ->where('type', $request->type)
                ->get()
        ));
    }

    #[
        Post(
            path: '/api/categories',
            operationId: 'category-create',
            summary: 'Create category',
            security: [
                ['bearer' => []],
            ],
            requestBody: new RequestBody(StoreCategoryRequest::class),
            tags: ['Categories'],
            responses: [
                new EntityResponse(CategorySchema::class),
            ],
        )
    ]
    public function store(StoreCategoryRequest $request)
    {
        return $this->responseSuccess(new CategoryResource(
            $this->service->create($request->toDto(), $request->user()->id)
        ));
    }

    #[
        Get(
            path: '/api/categories/{category}',
            operationId: 'category-get',
            summary: 'Get category',
            security: [
                ['bearer' => []],
            ],
            tags: ['Categories'],
            parameters: [
                new PathParameter('category', 4),
            ],
            responses: [
                new EntityResponse(CategorySchema::class),
            ],
        )
    ]
    public function show(Category $category)
    {
        return $this->responseSuccess(new CategoryResource($category));
    }

    #[
        Put(
            path: '/api/categories/{category}',
            operationId: 'category-update',
            summary: 'Update category',
            security: [
                ['bearer' => []],
            ],
            requestBody: new RequestBody(UpdateCategoryRequest::class),
            tags: ['Categories'],
            parameters: [
                new PathParameter('category', 4),
            ],
            responses: [
                new EntityResponse(CategorySchema::class),
            ],
        )
    ]
    public function update(UpdateCategoryRequest $request, Category $category)
    {
        $category->update($request->validated());

        return $this->responseSuccess(new CategoryResource($category));
    }

    #[
        Delete(
            path: '/api/categories/{category}',
            operationId: 'category-delete',
            summary: 'Delete category',
            security: [
                ['bearer' => []],
            ],
            tags: ['Categories'],
            parameters: [
                new PathParameter('category', 4),
            ],
            responses: [
                new NoContentResponse(),
            ],
        )
    ]
    public function destroy(Category $category)
    {
        if ($category->items()->count()) {
            return $this->responseError(['У категории есть товары/сделки пожалуйста удалите их или измените у них категорию'], 422);
        }
        $category->delete();

        return $this->responseNoContent();
    }
}
