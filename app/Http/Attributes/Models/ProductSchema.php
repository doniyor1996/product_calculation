<?php

namespace App\Http\Attributes\Models;

use App\Http\Attributes\Properties\DateTimeProperty;
use App\Http\Attributes\Properties\FloatProperty;
use App\Http\Attributes\Properties\IntegerProperty;
use App\Http\Attributes\Properties\ObjectProperty;
use App\Http\Attributes\Properties\StringProperty;
use OpenApi\Attributes\Schema;

class ProductSchema extends Schema
{
    public function __construct()
    {
        parent::__construct(
            schema: 'CustomerSchema',
            properties: [
                new IntegerProperty('id', 1),
                new StringProperty('name'),
                new StringProperty('description'),
                new FloatProperty('price', 15.0),
                new FloatProperty('cost', 15.0),
                new IntegerProperty('category_id', 1),
                new ObjectProperty('category', [
                    new IntegerProperty('id', 1),
                    new StringProperty('name'),
                ]),
                new DateTimeProperty('created_at'),
                new DateTimeProperty('updated_at'),
            ]
        );
    }
}
