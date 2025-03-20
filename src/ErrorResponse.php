<?php
declare(strict_types = 1);

namespace Middlewares;

use Middlewares\ErrorResponder\HtmlResponder;
use Middlewares\ErrorResponder\JsonResponder;
use Middlewares\ErrorResponder\ResponderInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\MiddlewareInterface;
use Psr\Http\Server\RequestHandlerInterface;

class ErrorResponse implements MiddlewareInterface
{
    /**
     * @var ResponderInterface[]|null
     */
    private $responders;

    /**
     * @param ResponderInterface[]|null $responders
     */
    public function __construct(?array $responders = null)
    {
        if ($responders === null) {
            $responders = [
                new HtmlResponder(),
                new JsonResponder(),
            ];
        }

        $this->responders = $responders;
    }

    /**
     * Process a request and return a response.
     */
    public function process(ServerRequestInterface $request, RequestHandlerInterface $handler): ResponseInterface
    {
        $response = $handler->handle($request);

        $code = $response->getStatusCode();

        if ($code < 400) {
            return $response;
        }

        foreach ($this->responders as $responder) {
            if ($responder->isValid($request, $response)) {
                return $responder->handle($request, $response);
            }
        }

        return $response;
    }
}
