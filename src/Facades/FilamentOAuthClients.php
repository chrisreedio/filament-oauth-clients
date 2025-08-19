<?php

namespace ChrisReedIO\FilamentOAuthClients\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @see \ChrisReedIO\FilamentOAuthClients\FilamentOAuthClients
 */
class FilamentOAuthClients extends Facade
{
    protected static function getFacadeAccessor()
    {
        return \ChrisReedIO\FilamentOAuthClients\FilamentOAuthClients::class;
    }
}
