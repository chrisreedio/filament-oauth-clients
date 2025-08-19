<?php

namespace ChrisReedIO\FilamentOAuthClients\Clusters\OAuth\Resources\PersonalAccessTokenResource\Pages;

use ChrisReedIO\FilamentOAuthClients\Clusters\OAuth\Resources\PersonalAccessTokenResource;
use ChrisReedIO\FilamentOAuthClients\Traits\HasPageClipboard;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;

class ViewPersonalAccessToken extends ViewRecord
{
    use HasPageClipboard;

    protected $listeners = ['copy-token-clipboard' => 'copyTokenClipboard'];

    protected static string $resource = PersonalAccessTokenResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\EditAction::make(),
        ];
    }
}
