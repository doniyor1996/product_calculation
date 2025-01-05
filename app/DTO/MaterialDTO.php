<?php

namespace App\DTO;

readonly class MaterialDTO
{
    public function __construct(
        public string $name,
        public int $categoryId,
        public string $description,
        public float $price,
    ) {}
}
