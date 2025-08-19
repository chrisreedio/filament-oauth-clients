<?php

namespace ChrisReedIO\FilamentOAuthClients\Clusters\OAuth\Resources\OAuthApplicationResource\Pages;

use ChrisReedIO\FilamentOAuthClients\Clusters\OAuth\Resources\OAuthApplicationResource;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;

class ViewOAuthApplication extends ViewRecord
{
    protected static string $resource = OAuthApplicationResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\EditAction::make(),
        ];
    }
}
