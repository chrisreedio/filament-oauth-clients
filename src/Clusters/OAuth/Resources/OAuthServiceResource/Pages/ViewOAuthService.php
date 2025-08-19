<?php

namespace ChrisReedIO\FilamentOAuthClients\Clusters\OAuth\Resources\OAuthServiceResource\Pages;

use ChrisReedIO\FilamentOAuthClients\Clusters\OAuth\Resources\OAuthServiceResource;
use ChrisReedIO\FilamentOAuthClients\Models\Traits\HasPageClipboard;
use Filament\Actions;
use Filament\Actions\Action;
use Filament\Notifications\Notification;
use Filament\Resources\Pages\ViewRecord;

class ViewOAuthService extends ViewRecord
{
    use HasPageClipboard;

    protected $listeners = ['copy-token-clipboard' => 'copyTokenClipboard'];

    protected static string $resource = OAuthServiceResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\Action::make('regenSecret')
                ->label(__('Regenerate Secret'))
                ->icon('heroicon-o-arrow-path')
                ->requiresConfirmation()
                ->action(function () {
                    // $this->record->regenerateSecret();
                    // $this->record->save();
                    /** @var \App\Models\OAuthService $service */
                    $service = $this->getRecord();
                    $service->regenerateSecret();
                    // $clientRepo = app(ClientRepository::class);
                    // $client = $clientRepo->regenerateSecret($this->getRecord());
                    Notification::make()
                        ->title('OAuth Client Secret Generated')
                        ->icon('far-key')
                        ->body('The Secret has been generated. Copy it now as it will not be shown again.')
                        ->success()
                        ->actions([
                            Action::make('Copy')
                                ->icon('heroicon-s-clipboard-document-check')
                                ->button()
                                ->dispatch('copy-token-clipboard', ['token' => $service->plainSecret]),
                        ])
                        ->persistent()
                        ->send();
                }),
            Actions\EditAction::make(),
        ];
    }
}
