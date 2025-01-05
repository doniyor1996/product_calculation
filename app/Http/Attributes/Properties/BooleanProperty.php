<?php

namespace App\Http\Attributes\Properties;

use OpenApi\Attributes\Property;

class BooleanProperty extends Property
{
    public function __construct(string $name)
    {
        parent::__construct($name, type: 'bool', example: true);
    }
}
