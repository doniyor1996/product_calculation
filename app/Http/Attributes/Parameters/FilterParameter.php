<?php

namespace App\Http\Attributes\Parameters;

class FilterParameter extends \OpenApi\Attributes\Parameter
{
    public function __construct(string $name, string $example, ?string $description = null)
    {
        parent::__construct(name: "filter[$name]", description: $description, in: 'query', example: $example);
    }
}
