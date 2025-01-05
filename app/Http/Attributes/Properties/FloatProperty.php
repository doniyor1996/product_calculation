<?php

namespace App\Http\Attributes\Properties;

use OpenApi\Attributes\Property;

class FloatProperty extends Property
{
    public function __construct(string $name, float $example = 1.00)
    {
        parent::__construct($name, type: 'float', example: $example);
    }
}
