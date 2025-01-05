<?php

namespace App\Http\Attributes\Responses;

use OpenApi\Attributes\Items;
use OpenApi\Attributes\JsonContent;
use OpenApi\Attributes\Property;
use OpenApi\Attributes\Response;

class EntityListResponse extends Response
{
    public function __construct(
        string $entitySchemaClass
    ) {
        parent::__construct(
            response: 200,
            description: 'List response',
            content: new JsonContent(
                properties: [
                    new Property(
                        property: 'status_code',
                        type: 'integer',
                        example: 200
                    ),
                    new Property(
                        property: 'data',
                        type: 'array',
                        items: new Items(
                            properties: (new $entitySchemaClass())->properties
                        )
                    ),
                    new Property(
                        property: 'page',
                        type: 'integer',
                        example: 1
                    ),
                    new Property(
                        property: 'per_page',
                        type: 'integer',
                        example: 30
                    ),
                    new Property(
                        property: 'total',
                        type: 'integer',
                        example: 60
                    ),
                    new Property(
                        property: 'last_page',
                        type: 'integer',
                        example: 2
                    ),
                ]
            )
        );
    }
}
