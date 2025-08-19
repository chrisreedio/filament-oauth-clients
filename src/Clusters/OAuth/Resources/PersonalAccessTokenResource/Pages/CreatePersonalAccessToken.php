<?php

namespace ChrisReedIO\FilamentOAuthClients\Clusters\OAuth\Resources\PersonalAccessTokenResource\Pages;

use ChrisReedIO\FilamentOAuthClients\Clusters\OAuth\Resources\PersonalAccessTokenResource;
use Filament\Resources\Pages\CreateRecord;

class CreatePersonalAccessToken extends CreateRecord
{
    protected static string $resource = PersonalAccessTokenResource::class;
}
