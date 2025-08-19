<?php

namespace ChrisReedIO\FilamentOAuthClients\Clusters\OAuth\Resources;

use BackedEnum;
use ChrisReedIO\FilamentOAuthClients\Clusters\OAuth;
use ChrisReedIO\FilamentOAuthClients\Clusters\OAuth\Resources\OAuthApplicationResource\Pages;
use ChrisReedIO\FilamentOAuthClients\Enums\OAuth\GrantType;
use ChrisReedIO\FilamentOAuthClients\Models\OAuthApplication;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Forms;
use Filament\Infolists;
use Filament\Resources\Resource;
use Filament\Schemas\Components\Grid;
use Filament\Schemas\Schema;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;

class OAuthApplicationResource extends Resource
{
    protected static ?string $model = OAuthApplication::class;

    protected static BackedEnum | string | null $navigationIcon = 'heroicon-o-computer-desktop';

    protected static ?string $navigationLabel = 'Applications';

    protected static ?string $label = 'Application';

    protected static ?string $pluralLabel = 'Applications';

    protected static ?string $cluster = OAuth::class;

    protected static ?string $slug = 'applications';

    public static function infolist(Schema $infolist): Schema
    {
        return $infolist
            ->columns(2)
            ->components([
                Grid::make(2)
                    ->columnSpan(1)
                    ->schema([
                        Infolists\Components\TextEntry::make('name')
                            ->columnSpan(2),
                        Infolists\Components\IconEntry::make('revoked')
                            ->label('Revoked')
                            ->boolean(),
                        Infolists\Components\TextEntry::make('created_at')
                            ->dateTime('F jS, Y g:i A T')
                            ->label('Created At'),
                    ]),
                Infolists\Components\TextEntry::make('redirect_uris')
                    ->label('Allowed Redirect URLs')
                    ->listWithLineBreaks()
                    ->separator(', '),
                // Infolists\Components\RepeatableEntry::make('redirect_uris')
                //     ->label('Redirect URIs')
                //     ->simple([
                //         Infolists\Components\TextEntry::make('uri')
                //             ->label('URI'),
                //     ]),

            ]);
    }

    public static function form(Schema $schema): Schema
    {
        return $schema
            ->columns(1)
            ->components([
                // Forms\Components\TextInput::make('owner_type')
                //     ->maxLength(255),
                // Forms\Components\TextInput::make('owner_id')
                //     ->numeric(),
                Forms\Components\TextInput::make('name')
                    ->required()
                    ->maxLength(255),
                // Forms\Components\TextInput::make('secret')
                // ->maxLength(255),
                // Forms\Components\Select::make('provider')
                //     ->selectablePlaceholder(false)
                //     ->native(false)
                //     ->options(fn () => array_keys(config('auth.providers')))
                //     ->default(fn () => array_keys(config('auth.providers'))[0])
                //     ->required(),
                // Forms\Components\Textarea::make('redirect_uris')
                // ->required()
                // ->columnSpanFull(),
                Forms\Components\Repeater::make('redirect_uris')
                    ->label('Allowed Redirect URLs')
                    // ->dehydrateStateUsing(fn (array $state): array => $state)
                    ->simple(
                        Forms\Components\TextInput::make('uri')
                            ->required()
                            ->label('URL')
                            ->maxLength(255),
                    ),
                // Forms\Components\Textarea::make('grant_types')
                // ->required()
                // ->columnSpanFull(),
                // Forms\Components\Toggle::make('revoked')
                // ->required(),
                // Forms\Components\TextInput::make('scopes')
                // ->required(),
                // Forms\Components\TextInput::make('type')
                // ->maxLength(255),
                // Forms\Components\Textarea::make('description')
                // ->columnSpanFull(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->modifyQueryUsing(function (Builder $query) {
                // return OAuthClient::query()
                return $query
                    ->with('owner')
                    ->where('grant_types', 'like', '%' . GrantType::AUTHORIZATION_CODE->value . '%');
            })
            ->recordUrl(fn (OAuthApplication $record) => self::getUrl('view', ['record' => $record->id]))
            ->description('Applications use the Authorization Code grant type to authenticate users.')
            ->columns([
                Tables\Columns\TextColumn::make('id')
                    ->label('ID')
                    ->toggleable(isToggledHiddenByDefault: true),
                // Tables\Columns\TextColumn::make('owner_type')
                //     ->searchable(),
                // Tables\Columns\TextColumn::make('owner_id')
                //     ->numeric()
                //     ->sortable(),
                Tables\Columns\TextColumn::make('owner.name')
                    ->placeholder('System'),
                Tables\Columns\TextColumn::make('name')
                    ->searchable(),
                // Tables\Columns\TextColumn::make('secret')
                // ->limit(10)
                // ->searchable(),
                // Tables\Columns\TextColumn::make('provider')
                // ->badge()
                // ->searchable(),
                // Tables\Columns\TextColumn::make('grant_types')
                // ->badge()
                // ->searchable(),
                Tables\Columns\TextColumn::make('redirect_uris')
                    // ->badge()
                    ->separator(', ')
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
            ->recordActions([
                // Tables\Actions\ViewAction::make(),
                EditAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
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
            'index' => Pages\ListOAuthApplications::route('/'),
            'create' => Pages\CreateOAuthApplication::route('/create'),
            'view' => Pages\ViewOAuthApplication::route('/{record}'),
            'edit' => Pages\EditOAuthApplication::route('/{record}/edit'),
        ];
    }
}
