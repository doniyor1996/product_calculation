<?php

namespace App\Http\Controllers;

use App\Http\Attributes\Models\ProductSchema;
use App\Http\Attributes\Parameters\FilterParameter;
use App\Http\Attributes\Parameters\PageParameter;
use App\Http\Attributes\Parameters\PathParameter;
use App\Http\Attributes\Properties\ArrayProperty;
use App\Http\Attributes\Properties\FloatProperty;
use App\Http\Attributes\Properties\IntegerProperty;
use App\Http\Attributes\Properties\StringProperty;
use App\Http\Attributes\Requests\RequestBody;
use App\Http\Attributes\Responses\EntityListResponse;
use App\Http\Attributes\Responses\EntityResponse;
use App\Http\Attributes\Responses\NoContentResponse;
use App\Http\Requests\ProductListRequest;
use App\Http\Requests\StoreProductRequest;
use App\Http\Requests\UpdateProductRequest;
use App\Http\Resources\ProductResource;
use App\Http\Resources\ProductWithMaterialsResource;
use App\Models\Product;
use App\Services\ProductService;
use Illuminate\Http\JsonResponse;
use OpenApi\Attributes\Delete;
use OpenApi\Attributes\Get;
use OpenApi\Attributes\JsonContent;
use OpenApi\Attributes\Post;
use OpenApi\Attributes\Put;

class ProductController extends Controller
{
    public function __construct(
        private readonly ProductService $service,
    ) {
        $this->authorizeResource(Product::class, 'product');
    }

    #[
        Get(
            path: '/api/products',
            operationId: 'products-list-get',
            summary: 'Get products',
            security: [
                ['bearer' => []]
            ],
            tags: ['Products'],
            parameters: [
                new PageParameter(),
                new PageParameter('per_page', 30),
                new FilterParameter('name', 'Стул'),
                new FilterParameter('category_id', 2),
            ],
            responses: [
                new EntityListResponse(ProductSchema::class),
            ],
        )
    ]
    public function index(ProductListRequest $request)
    {
        $pagination = $this->service->list($request->validated(), $request->user()->id);

        return $this->responseWithPagination(ProductResource::collection($pagination->items()), $pagination);
    }

    #[
        Post(
            path: '/api/products',
            operationId: 'products-create',
            summary: 'Create product',
            security: [
                ['bearer' => []]
            ],
            requestBody: new \OpenApi\Attributes\RequestBody(
                content: new JsonContent(
                    properties: [
                        new StringProperty('name'),
                        new StringProperty('description'),
                        new FloatProperty('price'),
                        new IntegerProperty('category_id'),
                        new ArrayProperty('materials', [
                            new IntegerProperty('material_id'),
                            new FloatProperty('quantity'),
                        ]),
                    ],
                )
            ),
            tags: ['Products'],
            responses: [
                new EntityResponse(ProductSchema::class),
            ],
        )
    ]
    public function store(StoreProductRequest $request): JsonResponse
    {
        return $this->responseSuccess(new ProductWithMaterialsResource($this->service->create($request->validated(), $request->user()->id)));
    }

    #[
        Get(
            path: '/api/products/{product}',
            operationId: 'products-get',
            summary: 'Get product',
            security: [
                ['bearer' => []]
            ],
            tags: ['Products'],
            parameters: [
                new PathParameter('product', 1),
            ],
            responses: [
                new EntityResponse(ProductSchema::class),
            ],
        )
    ]
    public function show(Product $product)
    {
        return $this->responseSuccess(new ProductWithMaterialsResource($product));
    }

    #[
        Put(
            path: '/api/products/{product}',
            operationId: 'products-update',
            summary: 'Update product',
            security: [
                ['bearer' => []]
            ],
            requestBody: new RequestBody(UpdateProductRequest::class),
            tags: ['Products'],
            parameters: [
                new PathParameter('product', 1),
            ],
            responses: [
                new EntityResponse(ProductSchema::class),
            ],
        )
    ]
    public function update(UpdateProductRequest $request, Product $product): JsonResponse
    {
        return $this->responseSuccess(new ProductWithMaterialsResource($this->service->update($product, $request->validated())));
    }

    #[
        Delete(
            path: '/api/products/{product}',
            operationId: 'product-delete',
            summary: 'Delete product',
            security: [
                ['bearer' => []]
            ],
            tags: ['Products'],
            parameters: [
                new PathParameter('product'),
            ],
            responses: [
                new NoContentResponse(),
            ],
        )
    ]
    public function destroy(Product $product): JsonResponse
    {
        $product->delete();

        return $this->responseNoContent();
    }
}
