# middlewares/error-response

[![Latest Version on Packagist][ico-version]][link-packagist]
[![Software License][ico-license]](LICENSE)
[![Build Status][ico-travis]][link-travis]
[![Quality Score][ico-scrutinizer]][link-scrutinizer]
[![Total Downloads][ico-downloads]][link-downloads]

Middleware to format responses with HTTP error codes (4xx-5xx).

## Requirements

* PHP >= 7.0
* A [PSR-7 http library](https://github.com/middlewares/awesome-psr15-middlewares#psr-7-implementations)
* A [PSR-15 middleware dispatcher](https://github.com/middlewares/awesome-psr15-middlewares#dispatcher)

## Installation

This package is installable and autoloadable via Composer as [middlewares/error-response](https://packagist.org/packages/middlewares/error-response).

```sh
composer require middlewares/error-response
```

## Example

```php
use Middlewares\ErrorResponse;
use Middlewares\ErrorResponder\HtmlResponder;
use Middlewares\ErrorResponder\JsonResponder;

$dispatcher = new Dispatcher([
    new Middlewares\ErrorResponse([
        new HtmlResponder(),
        new JsonResponder()
    ])
]);

$response = $dispatcher->dispatch(new ServerRequest());
```

---

Please see [CHANGELOG](CHANGELOG.md) for more information about recent changes and [CONTRIBUTING](CONTRIBUTING.md) for contributing details.

The MIT License (MIT). Please see [LICENSE](LICENSE) for more information.

[ico-version]: https://img.shields.io/packagist/v/middlewares/error-response.svg?style=flat-square
[ico-license]: https://img.shields.io/badge/license-MIT-brightgreen.svg?style=flat-square
[ico-travis]: https://img.shields.io/travis/middlewares/error-response/master.svg?style=flat-square
[ico-scrutinizer]: https://img.shields.io/scrutinizer/g/middlewares/error-response.svg?style=flat-square
[ico-downloads]: https://img.shields.io/packagist/dt/middlewares/error-response.svg?style=flat-square

[link-packagist]: https://packagist.org/packages/middlewares/error-response
[link-travis]: https://travis-ci.org/middlewares/error-response
[link-scrutinizer]: https://scrutinizer-ci.com/g/middlewares/error-response
[link-downloads]: https://packagist.org/packages/middlewares/error-response
