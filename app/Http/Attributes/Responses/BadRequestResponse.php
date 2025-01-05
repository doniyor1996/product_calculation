<?php

namespace App\Http\Attributes\Responses;

use OpenApi\Attributes\Items;
use OpenApi\Attributes\JsonContent;
use OpenApi\Attributes\Property;
use OpenApi\Attributes\Response;

class BadRequestResponse extends Response
{
    public function __construct(string $message = 'Bad request', int $code = 422)
    {
        parent::__construct(
            response: $code,
            description: $message,
            content: new JsonContent(
                properties: [
                    new Property(
                        property: 'status_code',
                        type: 'integer',
                        example: $code,
                    ),
                    new Property(
                        property: 'message',
                        type: 'string',
                        example: $message,
                    ),
                    new Property(
                        property: 'errors',
                        type: 'array',
                        items: new Items(example: $message),
                    ),
                ]
            )
        );
    }
}
