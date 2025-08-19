<?php

namespace ChrisReedIO\FilamentOAuthClients\Clusters\OAuth\Resources\PersonalAccessTokenResource\Pages;

use ChrisReedIO\FilamentOAuthClients\Clusters\OAuth\Resources\PersonalAccessTokenResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditPersonalAccessToken extends EditRecord
{
    protected static string $resource = PersonalAccessTokenResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\ViewAction::make(),
            Actions\DeleteAction::make(),
        ];
    }
}
