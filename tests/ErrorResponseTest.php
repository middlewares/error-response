<?php

namespace Middlewares\Tests;

use Middlewares\ErrorResponder\HtmlResponder;
use Middlewares\ErrorResponder\JsonResponder;
use Middlewares\ErrorResponse;
use Middlewares\Utils\Dispatcher;
use Middlewares\Utils\Factory;
use PHPUnit\Framework\TestCase;

class ErrorResponseTest extends TestCase
{
    public function testHtmlErrorResponse()
    {
        $request = Factory::createServerRequest('GET', '/');

        $response = Dispatcher::run([
            new ErrorResponse([
                new HtmlResponder(),
                new JsonResponder(),
            ]),
            function ($req, $next) {
                return Factory::createResponse(404)->withHeader('Content-Type', 'text/HTML; charset=UTF-8');
            },
        ], $request);

        $this->assertSame(404, $response->getStatusCode());

        $content = <<<'HTML'
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>404 - Not Found</title>
    <style>html{font-family: sans-serif;}</style>
    <meta name="viewport" content="width=device-width, initial-scale=1">
</head>
<body>
    <h1>Error 404</h1>
    <p>Not Found</p>
</body>
</html>
HTML;
        $this->assertEquals($content, (string) $response->getBody());
    }

    public function testJsonErrorResponse()
    {
        $request = Factory::createServerRequest('GET', '/');

        $response = Dispatcher::run([
            new ErrorResponse(),
            function ($req, $next) {
                return Factory::createResponse(500)->withHeader('Content-Type', 'application/json');
            },
        ], $request);

        $this->assertSame(500, $response->getStatusCode());
        $json = \json_decode((string) $response->getBody(), true);

        $this->assertEquals($json, ['code' => 500, 'message' => 'Internal Server Error']);
    }
}
