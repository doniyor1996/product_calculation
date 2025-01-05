<?php

namespace App\Http\Attributes\Models;

use App\Enums\CategoryTypesEnum;
use App\Http\Attributes\Properties\DateTimeProperty;
use App\Http\Attributes\Properties\IntegerProperty;
use App\Http\Attributes\Properties\StringProperty;
use OpenApi\Attributes\Schema;

class CategorySchema extends Schema
{
    public function __construct()
    {
        parent::__construct(
            schema: 'Category',
            properties: [
                new IntegerProperty('id', 1),
                new StringProperty('name'),
                new StringProperty('type', 'product', CategoryTypesEnum::values()),
                new DateTimeProperty('created_at'),
                new DateTimeProperty('updated_at'),
            ]
        );
    }
}
