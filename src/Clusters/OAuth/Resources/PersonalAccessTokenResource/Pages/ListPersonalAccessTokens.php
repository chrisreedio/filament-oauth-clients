<?php

namespace ChrisReedIO\FilamentOAuthClients\Clusters\OAuth\Resources\PersonalAccessTokenResource\Pages;

use App\Models\PersonalAccessToken;
use ChrisReedIO\FilamentOAuthClients\Clusters\OAuth\Resources\PersonalAccessTokenResource;
use ChrisReedIO\FilamentOAuthClients\Traits\HasPageClipboard;
use Filament\Actions;
use Filament\Notifications\Actions\Action;
use Filament\Notifications\Notification;
use Filament\Resources\Pages\ListRecords;
use Filament\Support\Enums\MaxWidth;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class ListPersonalAccessTokens extends ListRecords
{
    use HasPageClipboard;

    protected $listeners = ['copy-token-clipboard' => 'copyTokenClipboard'];

    protected static string $resource = PersonalAccessTokenResource::class;

    public function getMaxContentWidth(): MaxWidth
    {
        return MaxWidth::Full;
    }

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make()
                ->slideOver()
                ->modalWidth('md')
                ->using(function (array $data, string $model): Model {
                    $curUser = Auth::user();

                    $token = $curUser->createToken($data['name']);

                    Notification::make()
                        ->title('Personal Access Token Generated')
                        ->icon('heroicon-o-key')
                        ->body('The Personal Access Token has been created. Copy it now as it will not be shown again.')
                        ->success()
                        ->actions([
                            Action::make('Copy')
                                ->icon('heroicon-s-clipboard-document-check')
                                ->button()
                                ->dispatch('copy-token-clipboard', ['token' => $token->accessToken]),
                        ])
                        ->persistent()
                        ->send();

                    return PersonalAccessToken::find($token->getToken()->id);

                    // Regenerate the client secret
                    // $token->regenerateSecret();
                    // return $token->getToken();
                })
                // ->successRedirectUrl(fn (PersonalAccessToken $record) => PersonalAccessTokenResource::getUrl('view', ['record' => $record->id]))
                // ->successNotification(function (PersonalAccessToken $record) {
                //     $record->regenerateSecret();

                //     return Notification::make()
                //         ->title('Personal Access Token Generated')
                //         ->icon('heroicon-o-key')
                //         ->body('The Personal Access Token has been created. Copy it now as it will not be shown again.')
                //         ->success()
                //         ->actions([
                //             Action::make('Copy')
                //                 ->icon('heroicon-s-clipboard-document-check')
                //                 ->button()
                //                 ->dispatch('copy-token-clipboard', ['token' => $record->plainSecret]),
                //         ])
                //         ->persistent();
                // })
                ->successNotification(null),
        ];
    }
}
