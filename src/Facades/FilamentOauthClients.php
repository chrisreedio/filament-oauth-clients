<?php

namespace ChrisReedIO\FilamentOAuthClients\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @see \ChrisReedIO\FilamentOAuthClients\FilamentOauthClients
 */
class FilamentOauthClients extends Facade
{
    protected static function getFacadeAccessor()
    {
        return \ChrisReedIO\FilamentOAuthClients\FilamentOauthClients::class;
    }
}
