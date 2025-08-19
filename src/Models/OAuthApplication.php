<?php

namespace ChrisReedIO\FilamentOAuthClients\Models;

use ChrisReedIO\FilamentOAuthClients\Enums\OAuth\GrantType;
use ChrisReedIO\FilamentOAuthClients\Models\Passport\Client;

class OAuthApplication extends Client
{
    protected $fillable = [
        'type',
        'secret',
        'name',
        'owner_id',
        'owner_type',
        'redirect_uris',
        'grant_types',
        'revoked',
    ];

    // We need a on boot handler to set the appropriate grant types
    protected static function booted(): void
    {
        parent::booted();

        static::creating(function (self $application) {
            $application->grant_types = [GrantType::AUTHORIZATION_CODE->value, GrantType::REFRESH_TOKEN->value];
        });
    }
}
