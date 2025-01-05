<?php

namespace App\Enums;

trait BaseEnums
{
    public static function values(): array
    {
        return array_map(fn ($case) => $case->value, static::cases());
    }
}
