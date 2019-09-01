<?php
declare(strict_types = 1);

namespace Middlewares\ErrorResponder;

use Middlewares\Utils\Factory;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Message\StreamFactoryInterface;

abstract class AbstractResponder implements ResponderInterface
{
    /** @var StreamFactoryInterface */
    protected $streamFactory;

    protected $statusCodes = ['/^(4|5)\d\d/'];
    protected $contentTypes = [];

    public function __construct(
        StreamFactoryInterface $streamFactory = null,
        array $statusCodes = null,
        array $contentTypes = null
    ) {
        $this->streamFactory = $streamFactory ?? Factory::getStreamFactory();

        if ($statusCodes !== null) {
            $this->statusCodes = $statusCodes;
        }

        if ($contentTypes !== null) {
            $this->contentTypes = $contentTypes;
        }
    }

    public function isValid(ServerRequestInterface $request, ResponseInterface $response): bool
    {
        $statusCode = (string) $response->getStatusCode();
        $contentType = $response->getHeaderLine('Content-Type');

        foreach ($this->statusCodes as $exp) {
            if (!self::matches($statusCode, (string) $exp)) {
                continue;
            }

            foreach ($this->contentTypes as $exp) {
                if (self::matches($contentType, $exp)) {
                    return true;
                }
            }
        }

        return false;
    }

    abstract public function getBodyContent(int $code, string $message): string;

    public function handle(ServerRequestInterface $request, ResponseInterface $response): ResponseInterface
    {
        $code = $response->getStatusCode();
        $message = $response->getReasonPhrase();

        $body = $this->streamFactory->createStream($this->getBodyContent($code, $message));

        return $response->withBody($body);
    }

    private static function matches(string $value, string $exp): bool
    {
        if ($exp[0] === '/') {
            return (bool) \preg_match($exp, $value);
        }

        return $exp === $value;
    }
}
