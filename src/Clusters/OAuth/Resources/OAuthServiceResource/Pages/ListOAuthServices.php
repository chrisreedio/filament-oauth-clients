<?php

namespace ChrisReedIO\FilamentOAuthClients\Clusters\OAuth\Resources\OAuthServiceResource\Pages;

use ChrisReedIO\FilamentOAuthClients\Clusters\OAuth\Resources\OAuthServiceResource;
use ChrisReedIO\FilamentOAuthClients\Models\OAuthService;
use Filament\Actions;
use Filament\Notifications\Actions\Action;
use Filament\Notifications\Notification;
use Filament\Resources\Pages\ListRecords;
use Filament\Support\Enums\Width;
use Illuminate\Database\Eloquent\Model;

class ListOAuthServices extends ListRecords
{
    protected static string $resource = OAuthServiceResource::class;

    public function getMaxContentWidth(): Width
    {
        return Width::Full;
    }

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make()
                ->slideOver()
                ->modalWidth('md')
                ->using(function (array $data, string $model): Model {
                    /** @var \App\Models\OAuthService $newService */
                    $newService = $model::create($data);

                    // Regenerate the client secret
                    $newService->regenerateSecret();

                    Notification::make()
                        ->title('OAuth Client Secret Generated')
                        ->icon('far-key')
                        ->body('The Secret has been generated. Copy it now as it will not be shown again.')
                        ->success()
                        ->actions([
                            Action::make('Copy')
                                ->icon('heroicon-s-clipboard-document-check')
                                ->button()
                                ->dispatch('copy-token-clipboard', ['token' => $newService->plainSecret]),
                        ])
                        ->persistent();

                    return $newService;
                })
                ->successRedirectUrl(fn (OAuthService $record) => OAuthServiceResource::getUrl('view', ['record' => $record->id]))
                ->successNotification(function (OAuthService $record) {

                    $record->regenerateSecret();
                    // dd($record->plainSecret);

                    return Notification::make()
                        ->title('OAuth Client Secret Generated')
                        ->icon('heroicon-o-key')
                        ->body('The Secret has been generated. Copy it now as it will not be shown again.')
                        ->success()
                        ->actions([
                            Action::make('Copy')
                                ->icon('heroicon-s-clipboard-document-check')
                                ->button()
                                ->dispatch('copy-token-clipboard', ['token' => $record->plainSecret]),
                        ])
                        ->persistent();
                }),
        ];
    }
}
