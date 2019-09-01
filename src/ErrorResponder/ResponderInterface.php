<?php
declare(strict_types = 1);

namespace Middlewares\ErrorResponder;

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

interface ResponderInterface
{
    /**
     * Check whether the error can be handled by this responder
     */
    public function isValid(ServerRequestInterface $request, ResponseInterface $response): bool;

    /**
     * Create a response with this error
     */
    public function handle(ServerRequestInterface $request, ResponseInterface $response): ResponseInterface;
}
