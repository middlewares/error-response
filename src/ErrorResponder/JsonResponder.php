<?php
declare(strict_types = 1);

namespace Middlewares\ErrorResponder;

class JsonResponder extends AbstractResponder
{
    /** @var string[] */
    protected $contentTypes = ['application/json'];

    public function getBodyContent(int $code, string $message): string
    {
        return (string) json_encode(compact('code', 'message'));
    }
}
