<?php

namespace ChrisReedIO\FilamentOAuthClients\Clusters\OAuth\Resources;

use App\Enums\OAuth\GrantType;
use App\Models\OAuthService;
use ChrisReedIO\FilamentOAuthClients\Clusters\OAuth;
use ChrisReedIO\FilamentOAuthClients\Clusters\OAuth\Resources\OAuthServiceResource\Pages;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Infolists;
use Filament\Infolists\Infolist;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Str;

class OAuthServiceResource extends Resource
{
    protected static ?string $model = OAuthService::class;

    protected static ?string $navigationIcon = 'heroicon-o-cpu-chip';

    protected static ?string $navigationLabel = 'Services';

    protected static ?string $label = 'Service';

    protected static ?string $pluralLabel = 'Services';

    protected static ?string $slug = 'services';

    protected static ?string $cluster = OAuth::class;

    protected static ?string $recordTitleAttribute = 'name';

    public static function infolist(Infolist $infolist): Infolist
    {
        return $infolist
            ->schema([
                Infolists\Components\TextEntry::make('id')
                    ->copyable()
                    ->badge()
                    ->label('ID'),
                Infolists\Components\TextEntry::make('secret')
                    ->label('Secret')
                    // ->formatStateUsing(fn (string $state) => Str::mask($state, '*', 0, 10))
                    ->formatStateUsing(fn (string $state) => '********')
                    ->copyable(),
                Infolists\Components\Grid::make(3)
                    ->schema([
                        // Infolists\Components\TextEntry::make('name'),
                        Infolists\Components\TextEntry::make('revoked')
                            ->label('Revoked')
                            ->formatStateUsing(fn (bool $state) => $state ? 'Yes' : 'No')
                            ->color(fn (bool $state) => $state ? 'danger' : 'success'),
                        Infolists\Components\TextEntry::make('created_at')
                            ->label('Created At')
                            ->dateTime('F jS, Y g:i A T'),
                        Infolists\Components\TextEntry::make('updated_at'),
                    ]),
            ]);
    }

    public static function form(Form $form): Form
    {
        return $form
            ->columns(1)
            ->schema([
                Forms\Components\TextInput::make('name')
                    ->required()
                    ->maxLength(255),

            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->description('Services use the Client Credentials grant type to authenticate automated processes.')
            ->recordUrl(fn (OAuthService $record) => self::getUrl('view', ['record' => $record->id]))
            ->modifyQueryUsing(function (Builder $query) {
                return $query
                    ->with('owner')
                    ->where('grant_types', 'like', '%' . GrantType::CLIENT_CREDENTIALS->value . '%');
            })
            ->columns([
                Tables\Columns\TextColumn::make('id')
                    ->label('ID')
                    ->toggleable(isToggledHiddenByDefault: false),
                // Tables\Columns\TextColumn::make('owner_type')
                //     ->searchable(),
                // Tables\Columns\TextColumn::make('owner_id')
                //     ->numeric()
                //     ->sortable(),
                Tables\Columns\TextColumn::make('owner.name')
                    ->placeholder('System'),
                Tables\Columns\TextColumn::make('name')
                    ->searchable(),
                Tables\Columns\IconColumn::make('revoked')
                    ->boolean(),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                //
            ])
            ->actions([
                // Tables\Actions\ViewAction::make(),
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListOAuthServices::route('/'),
            // 'create' => Pages\CreateOAuthService::route('/create'),
            'view' => Pages\ViewOAuthService::route('/{record}'),
            'edit' => Pages\EditOAuthService::route('/{record}/edit'),
        ];
    }
}
