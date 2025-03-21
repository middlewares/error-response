<?php
declare(strict_types = 1);

namespace Middlewares\ErrorResponder;

class HtmlResponder extends AbstractResponder
{
    /** @var string[] */
    protected $contentTypes = ['text/html'];

    public function getBodyContent(int $code, string $message): string
    {
        return <<<HTML
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>$code - $message</title>
    <style>html{font-family: sans-serif;}</style>
    <meta name="viewport" content="width=device-width, initial-scale=1">
</head>
<body>
    <h1>Error $code</h1>
    <p>$message</p>
</body>
</html>
HTML;
    }
}
