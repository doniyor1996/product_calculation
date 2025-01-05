<?php

namespace App\Http\Attributes\Requests;

use App\Http\Attributes\Properties\DateTimeProperty;
use App\Http\Attributes\Properties\FloatProperty;
use App\Http\Attributes\Properties\IntegerProperty;
use App\Http\Attributes\Properties\StringProperty;
use OpenApi\Attributes\JsonContent;

class RequestBody extends \OpenApi\Attributes\RequestBody
{
    public function __construct(string $requestClass, string $description = '')
    {
        /**
         * @var \App\Interfaces\SwaggerRequest $request
         */
        $request = new $requestClass();

        $properties = [];
        $examples = $request->examples();
        foreach ($request->rules() as $name => $rules) {
            $rules = !is_array($rules) ? explode('|', $rules) : $rules;
            $properties[] = match (true) {
                in_array('integer', $rules) => new IntegerProperty($name, $examples[$name] ?? 1),
                in_array('decimal', $rules) => new FloatProperty($name, $examples[$name] ?? 1.5),
                in_array('date', $rules) => new DateTimeProperty($name, $examples[$name] ?? 'string'),
                default => new StringProperty($name, $examples[$name] ?? 'string'),
            };
        }

        parent::__construct(description: $description, content: new JsonContent(
            properties: $properties,
        ));
    }
}
