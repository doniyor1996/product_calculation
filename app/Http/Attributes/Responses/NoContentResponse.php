<?php

namespace App\Http\Attributes\Responses;

use OpenApi\Attributes\Response;

class NoContentResponse extends Response
{
    public function __construct()
    {
        parent::__construct(
            response: 204,
            description: 'No content response'
        );
    }
}
