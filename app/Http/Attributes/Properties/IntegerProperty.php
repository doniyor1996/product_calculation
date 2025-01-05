<?php

namespace App\Http\Attributes\Properties;

use OpenApi\Attributes\Property;

class IntegerProperty extends Property
{
    public function __construct(string $name, int $example = 1, array $enum = null)
    {
        parent::__construct($name, type: 'integer', enum: $enum, example: $example);
    }
}
