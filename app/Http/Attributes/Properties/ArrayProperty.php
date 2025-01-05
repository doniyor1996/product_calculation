<?php

namespace App\Http\Attributes\Properties;

use OpenApi\Attributes\Items;
use OpenApi\Attributes\Property;

class ArrayProperty extends Property
{
    public function __construct(string $name, array $properties)
    {
        parent::__construct(
            $name,
            type: 'array',
            items: new Items(properties: $properties),
        );
    }
}
