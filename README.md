# Filament OAuth Clients

[![Latest Version on Packagist](https://img.shields.io/packagist/v/chrisreedio/filament-oauth-clients.svg?style=flat-square)](https://packagist.org/packages/chrisreedio/filament-oauth-clients)
[![GitHub Tests Action Status](https://img.shields.io/github/actions/workflow/status/chrisreedio/filament-oauth-clients/run-tests.yml?branch=main&label=tests&style=flat-square)](https://github.com/chrisreedio/filament-oauth-clients/actions?query=workflow%3Arun-tests+branch%3Amain)
[![GitHub Code Style Action Status](https://img.shields.io/github/actions/workflow/status/chrisreedio/filament-oauth-clients/fix-php-code-style-issues.yml?branch=main&label=code%20style&style=flat-square)](https://github.com/chrisreedio/filament-oauth-clients/actions?query=workflow%3A"Fix+PHP+code+styling"+branch%3Amain)
[![Total Downloads](https://img.shields.io/packagist/dt/chrisreedio/filament-oauth-clients.svg?style=flat-square)](https://packagist.org/packages/chrisreedio/filament-oauth-clients)

> **⚠️ Early Development**: This package is currently in active development. APIs may change before the stable release.

A Filament plugin for managing OAuth 2.0 clients using Laravel Passport. Provides a clean admin interface for managing OAuth applications, services, and personal access tokens.

## Features

- Manage OAuth applications and services
- Create and manage personal access tokens
- Built-in support for Laravel Passport
- Clean Filament admin interface with organized resource clustering

## Installation

```bash
composer require chrisreedio/filament-oauth-clients
```

Add the plugin to your Filament panel:

```php
use ChrisReedIO\FilamentOAuthClients\FilamentOAuthClientsPlugin;

public function panel(Panel $panel): Panel
{
    return $panel
        ->plugins([
            FilamentOAuthClientsPlugin::make(),
        ]);
}
```

## Requirements

- PHP 8.3+
- Laravel Passport
- Filament v4

## Testing

```bash
composer test
```

## Changelog

Please see [CHANGELOG](CHANGELOG.md) for more information on what has changed recently.

## Contributing

Please see [CONTRIBUTING](.github/CONTRIBUTING.md) for details.

## Security Vulnerabilities

Please review [our security policy](../../security/policy) on how to report security vulnerabilities.

## Credits

- [Chris Reed](https://github.com/chrisreedio)
- [All Contributors](../../contributors)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
