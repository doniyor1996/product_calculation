<?php

namespace App\Enums;

enum CategoryTypesEnum: string
{
    use BaseEnums;

    case MATERIAL = 'material';
    case PRODUCT = 'product';
}
