<?php

namespace App\Http\Controllers;

use App\Http\Attributes\Models\MaterialSchema;
use App\Http\Attributes\Parameters\FilterParameter;
use App\Http\Attributes\Parameters\PageParameter;
use App\Http\Attributes\Parameters\PathParameter;
use App\Http\Attributes\Requests\RequestBody;
use App\Http\Attributes\Responses\EntityListResponse;
use App\Http\Attributes\Responses\EntityResponse;
use App\Http\Attributes\Responses\NoContentResponse;
use App\Http\Requests\StoreMaterialRequest;
use App\Http\Requests\UpdateMaterialRequest;
use App\Http\Resources\MaterialResource;
use App\Models\Material;
use App\Services\MaterialService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use OpenApi\Attributes\Delete;
use OpenApi\Attributes\Get;
use OpenApi\Attributes\Post;
use OpenApi\Attributes\Put;

class MaterialController extends Controller
{
    public function __construct(
        protected MaterialService $service,
    )
    {
        $this->authorizeResource(Material::class, 'material');
    }

    #[
        Get(
            path: '/api/materials',
            operationId: 'materials-list-get',
            summary: 'Get materials',
            security: [
                ['bearer' => []],
            ],
            tags: ['Materials'],
            parameters: [
                new PageParameter(),
                new PageParameter('per_page', 30),
                new FilterParameter('name', 'Труба'),
                new FilterParameter('category_id', 2),
            ],
            responses: [
                new EntityListResponse(MaterialSchema::class),
            ],
        )
    ]
    public function index(Request $request): JsonResponse
    {
        return $this->responseSuccess(MaterialResource::collection(
            $this->service->list($request->all(), $request->user()->id)
        ));
    }

    #[
        Post(
            path: '/api/materials',
            operationId: 'materials-create',
            summary: 'Create material',
            security: [
                ['bearer' => []],
            ],
            requestBody: new RequestBody(StoreMaterialRequest::class),
            tags: ['Materials'],
            responses: [
                new EntityResponse(MaterialSchema::class),
            ],
        )
    ]
    public function store(StoreMaterialRequest $request)
    {
        return $this->responseSuccess(new MaterialResource(
            $this->service->create($request->toDto(), $request->user()->id)
        ));
    }

    #[
        Get(
            path: '/api/materials/{material}',
            operationId: 'material-get',
            summary: 'Get material',
            security: [
                ['bearer' => []],
            ],
            tags: ['Materials'],
            parameters: [
                new PathParameter('material', 4),
            ],
            responses: [
                new EntityResponse(MaterialSchema::class),
            ],
        )
    ]
    public function show(Material $material)
    {
        return $this->responseSuccess(new MaterialResource($material));
    }

    #[
        Put(
            path: '/api/materials/{material}',
            operationId: 'material-update',
            summary: 'Update material',
            security: [
                ['bearer' => []],
            ],
            requestBody: new RequestBody(UpdateMaterialRequest::class),
            tags: ['Materials'],
            parameters: [
                new PathParameter('material', 1),
            ],
            responses: [
                new EntityResponse(MaterialSchema::class),
            ],
        )
    ]
    public function update(UpdateMaterialRequest $request, Material $material)
    {
        return $this->responseSuccess(new MaterialResource($this->service->update($request->toDto(), $material)));
    }

    #[
        Delete(
            path: '/api/materials/{material}',
            operationId: 'material-delete',
            summary: 'Delete material',
            security: [
                ['bearer' => []],
            ],
            tags: ['Materials'],
            parameters: [
                new PathParameter('material', 4),
            ],
            responses: [
                new NoContentResponse(),
            ],
        )
    ]
    public function destroy(Material $material)
    {
        if ($material->products()->count()) {
            return $this->responseError(['Нельзя удалить. У материала есть продукты.'], 422);
        }
        $material->delete();

        return $this->responseNoContent();
    }
}
