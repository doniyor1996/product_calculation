<?php

namespace App\Http\Attributes\Parameters;

use OpenApi\Attributes\Parameter;

class PageParameter extends Parameter
{
    public function __construct(string $name = 'page', int $example = 1)
    {
        parent::__construct(name: $name, in: 'query', example: $example);
    }
}
