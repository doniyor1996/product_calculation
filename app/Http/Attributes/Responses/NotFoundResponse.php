<?php

namespace App\Http\Attributes\Responses;

use OpenApi\Attributes\Items;
use OpenApi\Attributes\JsonContent;
use OpenApi\Attributes\Property;
use OpenApi\Attributes\Response;

class NotFoundResponse extends Response
{
    public function __construct()
    {
        parent::__construct(
            response: 404,
            description: 'Not found response',
            content: new JsonContent(
                properties: [
                    new Property(
                        property: 'status_code',
                        type: 'integer',
                        example: 404,
                    ),
                    new Property(
                        property: 'message',
                        type: 'string',
                        example: 'Not found',
                    ),
                    new Property(
                        property: 'errors',
                        type: 'array',
                        items: new Items(example: 'Not found'),
                    ),
                ]
            )
        );
    }
}
