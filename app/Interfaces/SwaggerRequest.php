<?php

namespace App\Interfaces;

interface SwaggerRequest
{
    public function examples(): array;

    public function rules(): array;
}
