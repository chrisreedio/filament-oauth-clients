<?php

namespace ChrisReedIO\FilamentOAuthClients\Clusters\OAuth\Resources\OAuthApplicationResource\Pages;

use ChrisReedIO\FilamentOAuthClients\Clusters\OAuth\Resources\OAuthApplicationResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditOAuthApplication extends EditRecord
{
    protected static string $resource = OAuthApplicationResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\ViewAction::make(),
            Actions\DeleteAction::make(),
        ];
    }
}
