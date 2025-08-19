<?php

namespace ChrisReedIO\FilamentOAuthClients\Clusters\OAuth\Resources\OAuthServiceResource\Pages;

use ChrisReedIO\FilamentOAuthClients\Clusters\OAuth\Resources\OAuthServiceResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditOAuthService extends EditRecord
{
    protected static string $resource = OAuthServiceResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\ViewAction::make(),
            Actions\DeleteAction::make(),
        ];
    }
}
