<?php

namespace ChrisReedIO\FilamentOAuthClients\Models\Passport;

use Laravel\Passport\Token as BaseToken;

class Token extends BaseToken
{
    public $incrementing = false;

    protected $keyType = 'string';
}
