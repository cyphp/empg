# empg [![Build Status](https://travis-ci.org/cyphp/empg.svg?branch=master)](https://travis-ci.org/cyphp/empg)

[![Total Downloads](https://img.shields.io/packagist/dt/cyphp/empg.svg)](https://packagist.org/packages/cyphp/empg)
[![Latest Stable Version](https://img.shields.io/packagist/v/cyphp/empg.svg)](https://packagist.org/packages/cyphp/empg)

Enhanced MPG unified API library for PHP 7.x

Inspired by https://github.com/Moneris/eCommerce-Unified-API-PHP

## Features

- PHP 7.x compatible
- Improvement reliability
- Composer package
- Mimic as much as original class nomenclature

## Example
```php
require_once './vender/autoload.php';

use Empg\Client;

$client = new Client('MY_STORE_ID', 'MY_API_TOKEN');

$response = $client->post(
    new MpgRequest(
        new MpgTransaction([
            // ...
        ])
    )
);
```

## License
MIT
