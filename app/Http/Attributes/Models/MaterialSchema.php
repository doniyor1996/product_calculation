<?php

namespace App\Http\Attributes\Models;

use App\Enums\CategoryTypesEnum;
use App\Http\Attributes\Properties\DateTimeProperty;
use App\Http\Attributes\Properties\FloatProperty;
use App\Http\Attributes\Properties\IntegerProperty;
use App\Http\Attributes\Properties\StringProperty;
use OpenApi\Attributes\Schema;

class MaterialSchema extends Schema
{
    public function __construct()
    {
        parent::__construct(
            schema: 'Material',
            properties: [
                new IntegerProperty('id'),
                new IntegerProperty('category_id'),
                new StringProperty('category_name'),
                new StringProperty('name'),
                new StringProperty('description'),
                new FloatProperty('price'),
                new DateTimeProperty('created_at'),
                new DateTimeProperty('updated_at'),
            ]
        );
    }
}
