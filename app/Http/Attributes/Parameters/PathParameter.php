<?php

namespace App\Http\Attributes\Parameters;

use OpenApi\Attributes\Parameter;

class PathParameter extends Parameter
{
    public function __construct(string $name, $example = 1)
    {
        parent::__construct(name: $name, in: 'path', example: $example);
    }
}
