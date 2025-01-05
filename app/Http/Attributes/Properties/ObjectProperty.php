<?php

namespace App\Http\Attributes\Properties;

use OpenApi\Attributes\Property;

class ObjectProperty extends Property
{
    public function __construct(string $name, array $properties)
    {
        parent::__construct($name, properties: $properties, type: 'object');
    }
}
