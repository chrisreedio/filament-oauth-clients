<?php

namespace ChrisReedIO\FilamentOAuthClients\Clusters\OAuth\Resources\OAuthApplicationResource\Pages;

use ChrisReedIO\FilamentOAuthClients\Clusters\OAuth\Resources\OAuthApplicationResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;
use Filament\Support\Enums\MaxWidth;

class ListOAuthApplications extends ListRecords
{
    protected static string $resource = OAuthApplicationResource::class;

    public function getMaxContentWidth(): MaxWidth
    {
        return MaxWidth::Full;
    }

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
