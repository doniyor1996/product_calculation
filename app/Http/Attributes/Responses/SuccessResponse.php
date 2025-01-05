<?php

namespace App\Http\Attributes\Responses;

use OpenApi\Attributes\JsonContent;
use OpenApi\Attributes\Property;
use OpenApi\Attributes\Response;

class SuccessResponse extends Response
{
    public function __construct(
        array $dataProperties = []
    ) {
        $properties = [];
        foreach ($dataProperties as $dataProperty) {
            if ($dataProperty instanceof Property) {
                $properties[] = $dataProperty;
                continue;
            }
            $properties[] = new Property(
                property: $dataProperty['property'],
                type: $dataProperty['type'],
                example: $dataProperty['example'] ?? $dataProperty['type'],
            );
        }

        parent::__construct(
            response: 200,
            description: 'Success response',
            content: new JsonContent(
                properties: [
                    new Property(
                        property: 'data',
                        properties: $properties,
                        type: 'object',
                    ),
                ]
            )
        );
    }
}
