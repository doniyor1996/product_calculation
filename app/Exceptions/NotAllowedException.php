<?php

namespace App\Exceptions;

use Symfony\Component\HttpKernel\Exception\HttpException;

class NotAllowedException extends HttpException
{
    public function __construct(
        string $message = 'Access denied',
    ) {
        parent::__construct(403, $message);
    }
}
