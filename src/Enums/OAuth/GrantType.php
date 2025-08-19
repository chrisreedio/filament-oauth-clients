<?php

namespace ChrisReedIO\FilamentOAuthClients\Enums\OAuth;

use Filament\Support\Colors\Color;
use Filament\Support\Contracts\HasColor;
use Filament\Support\Contracts\HasLabel;

enum GrantType: string implements HasColor, HasLabel
{
    case CLIENT_CREDENTIALS = 'client_credentials';
    case AUTHORIZATION_CODE = 'authorization_code';
    case REFRESH_TOKEN = 'refresh_token';
    case PASSWORD = 'password';
    case IMPLICIT = 'implicit';
    case DEVICE_CODE = 'urn:ietf:params:oauth:grant-type:device_code';

    public function getLabel(): string
    {
        return match ($this) {
            self::CLIENT_CREDENTIALS => 'Client Credentials',
            self::AUTHORIZATION_CODE => 'Authorization Code',
            self::REFRESH_TOKEN => 'Refresh Token',
            self::PASSWORD => 'Password',
            self::IMPLICIT => 'Implicit',
            self::DEVICE_CODE => 'Device Code',
        };

    }

    public function getColor(): string | array | null
    {
        return match ($this) {
            self::CLIENT_CREDENTIALS => Color::Amber,
            self::AUTHORIZATION_CODE => Color::Blue,
            self::REFRESH_TOKEN => Color::Green,
            self::PASSWORD => Color::Yellow,
            self::IMPLICIT => Color::Red,
            self::DEVICE_CODE => Color::Purple,
        };
    }
}
