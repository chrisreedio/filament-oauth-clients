<?php

namespace ChrisReedIO\FilamentOAuthClients\Clusters\OAuth\Resources;

use BackedEnum;
use ChrisReedIO\FilamentOAuthClients\Clusters\OAuth;
use ChrisReedIO\FilamentOAuthClients\Clusters\OAuth\Resources\PersonalAccessTokenResource\Pages;
use ChrisReedIO\FilamentOAuthClients\Models\PersonalAccessToken;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Forms;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Tables;
use Filament\Tables\Table;

class PersonalAccessTokenResource extends Resource
{
    protected static ?string $model = PersonalAccessToken::class;

    protected static BackedEnum | string | null $navigationIcon = 'heroicon-o-user';

    protected static ?string $cluster = OAuth::class;

    public static function form(Schema $schema): Schema
    {
        return $schema
            ->columns(1)
            ->components([
                Forms\Components\TextInput::make('name')
                    ->required()
                    ->maxLength(255),
                // Forms\Components\TextInput::make('scopes')
                // ->required()
                // ->maxLength(255),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->description('Personal Access Tokens are used to authenticate developers to the API.')
            ->columns([
                Tables\Columns\TextColumn::make('name'),
                // Tables\Columns\TextColumn::make('client.name'),
                // Tables\Columns\TextColumn::make('user.name'),
                // Tables\Columns\TextColumn::make('scopes'),
                Tables\Columns\TextColumn::make('expires_at')
                    ->dateTime('F jS, Y g:i A T')
                    ->sortable(),
                Tables\Columns\IconColumn::make('revoked')
                    ->boolean(),
            ])
            ->filters([
                //
            ])
            ->recordActions([
                ViewAction::make(),
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
            'index' => Pages\ListPersonalAccessTokens::route('/'),
            // 'create' => Pages\CreatePersonalAccessToken::route('/create'),
            'view' => Pages\ViewPersonalAccessToken::route('/{record}'),
            'edit' => Pages\EditPersonalAccessToken::route('/{record}/edit'),
        ];
    }
}
