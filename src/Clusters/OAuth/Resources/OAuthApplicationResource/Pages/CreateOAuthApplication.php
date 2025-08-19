<?php

namespace ChrisReedIO\FilamentOAuthClients\Clusters\OAuth\Resources\OAuthApplicationResource\Pages;

use ChrisReedIO\FilamentOAuthClients\Clusters\OAuth\Resources\OAuthApplicationResource;
use Filament\Resources\Pages\CreateRecord;
use Illuminate\Database\Eloquent\Model;

class CreateOAuthApplication extends CreateRecord
{
    protected static string $resource = OAuthApplicationResource::class;

    protected ?string $subheading = 'Create a new OAuth application that uses the Authorization Code grant type.';

    protected ?string $maxContentWidth = '3xl';

    protected function handleRecordCreation(array $data): Model
    {
        return static::getModel()::create($data);
    }
}
