<?php

namespace App\Http\Attributes\Parameters;

use OpenApi\Attributes\Parameter;

class QueryParameter extends Parameter
{
    public function __construct(string $name, string $example = '1')
    {
        parent::__construct(name: $name, in: 'query', example: $example);
    }
}
