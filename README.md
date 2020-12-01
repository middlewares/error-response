# middlewares/error-response

[![Latest Version on Packagist][ico-version]][link-packagist]
[![Software License][ico-license]](LICENSE)
![Testing][ico-ga]
[![Total Downloads][ico-downloads]][link-downloads]

Middleware to format responses with HTTP error codes (4xx-5xx). Useful to create pretty 404 or 500 error pages.

## Requirements

* PHP >= 7.2
* A [PSR-7 http library](https://github.com/middlewares/awesome-psr15-middlewares#psr-7-implementations)
* A [PSR-15 middleware dispatcher](https://github.com/middlewares/awesome-psr15-middlewares#dispatcher)

## Installation

This package is installable and autoloadable via Composer as [middlewares/error-response](https://packagist.org/packages/middlewares/error-response).

```sh
composer require middlewares/error-response
```

### Example

```php
use Middlewares\ErrorResponse;

Dispatcher::run([
    new Middlewares\ErrorResponse()
]);
```

## Usage

The constructor accepts an array of responders, that must implement the `Middlewares\ErrorResponder\ResponderInterface`.
This package includes two basic responders: for html and json responses, that are enabled by default if no responders are passed.

```php
//The default responders (for html and js)
$responder = new Middlewares\ErrorResponse();

//Use your custom responders
$responder = new Middlewares\ErrorResponse([
    new MyHtmlResponder(),
    new MyJsonResponder()
]);
```

---

Please see [CHANGELOG](CHANGELOG.md) for more information about recent changes and [CONTRIBUTING](CONTRIBUTING.md) for contributing details.

The MIT License (MIT). Please see [LICENSE](LICENSE) for more information.

[ico-version]: https://img.shields.io/packagist/v/middlewares/error-response.svg?style=flat-square
[ico-license]: https://img.shields.io/badge/license-MIT-brightgreen.svg?style=flat-square
[ico-ga]: https://github.com/middlewares/error-response/workflows/testing/badge.svg
[ico-downloads]: https://img.shields.io/packagist/dt/middlewares/error-response.svg?style=flat-square

[link-packagist]: https://packagist.org/packages/middlewares/error-response
[link-downloads]: https://packagist.org/packages/middlewares/error-response
