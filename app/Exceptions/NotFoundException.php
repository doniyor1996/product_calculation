<?php

namespace App\Exceptions;

use Symfony\Component\HttpKernel\Exception\HttpException;

class NotFoundException extends HttpException
{
    public function __construct(
        string $message = 'Not found',
    ) {
        parent::__construct(404, $message);
    }
}
