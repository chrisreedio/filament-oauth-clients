# CLAUDE.md

This file provides guidance to Claude Code (claude.ai/code) when working with code in this repository.

## Project Overview

This is a Filament plugin package for managing OAuth 2.0 clients within Laravel applications using Laravel Passport. The package provides a comprehensive interface for creating, configuring, and managing OAuth clients, services, and personal access tokens through the Filament admin panel.

## Development Commands

### PHP/Composer Commands
- `composer test` - Run the test suite using Pest
- `composer analyse` - Run PHPStan static analysis
- `composer format` - Format code using Laravel Pint

### CSS/JS Build Commands  
- `npm run dev` - Start development mode (watches CSS and JS changes)
- `npm run build` - Build production assets (minified CSS and JS)
- `npm run dev:styles` - Watch and compile Tailwind CSS
- `npm run build:styles` - Build and minify CSS for production

### Testing
- `vendor/bin/pest` - Run tests directly
- `vendor/bin/pest --coverage` - Run tests with coverage report
- Uses PHPUnit configuration from `phpunit.xml.dist`

### Code Quality
- `vendor/bin/phpstan analyse` - Static analysis (configured in `phpstan.neon.dist`)
- `vendor/bin/pint` - Code formatting (configured in `pint.json` with Laravel preset)

## Architecture

### Plugin Structure
- **FilamentOAuthClientsPlugin**: Main plugin class that registers the OAuth cluster
- **FilamentOAuthClientsServiceProvider**: Service provider handling package registration, assets, commands, and migrations
- **OAuth Cluster**: Groups all OAuth-related resources under a single navigation group

### Resource Organization
The plugin uses Filament's cluster system to organize resources:

```
src/Clusters/OAuth/Resources/
├── OAuthApplicationResource/ - Manage OAuth applications
├── OAuthServiceResource/     - Manage OAuth services  
└── PersonalAccessTokenResource/ - Manage personal access tokens
```

Each resource follows Filament's standard structure with Pages for Create, Edit, List, and View operations.

### Models and Database
- **OAuthApplication**: Core OAuth client applications
- **OAuthService**: OAuth service configurations
- **PersonalAccessToken**: User personal access tokens
- **Passport Models**: Extended Laravel Passport models (AuthCode, Client, DeviceCode, RefreshToken, Token)
- Migration stub: `create_oauth_clients_table.php.stub`

### Key Dependencies
- Laravel Passport (^13.1) for OAuth functionality
- Filament v4 for admin interface
- Spatie Laravel Package Tools for package structure
- Tailwind CSS for styling

### Enums
- **ClientScope**: OAuth client scopes
- **ClientType**: OAuth client types (public, confidential)
- **GrantType**: OAuth grant types

## Package Publishing Commands

The package provides several publishable assets:
- `php artisan vendor:publish --tag="filament-oauth-clients-migrations"`
- `php artisan vendor:publish --tag="filament-oauth-clients-config"`
- `php artisan vendor:publish --tag="filament-oauth-clients-views"`
- `php artisan vendor:publish --tag="filament-oauth-clients-stubs"`

## Testing Environment

Tests use Orchestra Testbench with the full Filament stack. The TestCase sets up all required service providers and configures factory discovery for the package's models.