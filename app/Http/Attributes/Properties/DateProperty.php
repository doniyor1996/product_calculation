<?php

namespace App\Http\Attributes\Properties;

use OpenApi\Attributes\Property;

class DateProperty extends Property
{
    public function __construct(string $name, string $example = '2023-06-23')
    {
        parent::__construct($name, type: 'string', example: $example);
    }
}