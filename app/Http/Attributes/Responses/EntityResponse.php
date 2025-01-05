<?php

namespace App\Http\Attributes\Responses;

use App\Http\Attributes\Properties\IntegerProperty;
use OpenApi\Attributes\JsonContent;
use OpenApi\Attributes\Property;
use OpenApi\Attributes\Response;

class EntityResponse extends Response
{
    public function __construct(
        string $entitySchemaClass
    ) {
        parent::__construct(
            response: 200,
            description: 'Entity response',
            content: new JsonContent(
                properties: [
                    new IntegerProperty('status_code', 200),
                    new Property('data', description: 'Entity', properties: (new $entitySchemaClass())->properties, type: 'object'),
                ],
            )
        );
    }
}
