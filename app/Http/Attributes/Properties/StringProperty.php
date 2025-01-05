<?php

namespace App\Http\Attributes\Properties;

use OpenApi\Attributes\Property;

class StringProperty extends Property
{
    public function __construct(string $name, string $example = 'string', ?array $enum = null)
    {
        parent::__construct($name, type: 'string', enum: $enum, example: $example);
    }
}
