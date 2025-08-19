<?php

namespace ChrisReedIO\FilamentOAuthClients\Enums\OAuth;

use Filament\Support\Contracts\HasColor;
use Filament\Support\Contracts\HasIcon;
use Filament\Support\Contracts\HasLabel;

enum ClientType: string implements HasColor, HasIcon, HasLabel
{
    case Personal = 'personal';
    case Password = 'password';
    case ClientCredentials = 'client_credentials';
    case AuthCode = 'auth_code';

    #[\Override]
    public function getLabel(): ?string
    {
        return match ($this) {
            self::Personal => 'Personal',
            self::Password => 'Password',
            self::ClientCredentials => 'Client Credentials',
            self::AuthCode => 'Authorization Code',
        };
    }

    #[\Override]
    public function getIcon(): ?string
    {
        return match ($this) {
            self::Personal => 'heroicon-o-user',
            self::Password => 'heroicon-o-key',
            self::ClientCredentials => 'heroicon-o-server',
            self::AuthCode => 'heroicon-o-lock-closed',
        };
    }

    #[\Override]
    public function getColor(): string | array | null
    {
        return match ($this) {
            self::Personal => 'info',
            self::Password => 'warning',
            self::ClientCredentials => 'success',
            self::AuthCode => 'danger',
        };
    }
}
