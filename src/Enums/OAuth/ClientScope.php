<?php

namespace ChrisReedIO\FilamentOAuthClients\Enums\OAuth;

use Filament\Support\Contracts\HasColor;
use Filament\Support\Contracts\HasDescription;
use Filament\Support\Contracts\HasLabel;

enum ClientScope: string implements HasColor, HasDescription, HasLabel
{
    case ExampleRead = 'example:read';
    case ExampleWrite = 'example:write';

    // TODO: More will come later, starting simple

    #[\Override]
    public function getLabel(): ?string
    {
        return match ($this) {
            self::ExampleRead => 'Read Example',
            self::ExampleWrite => 'Write Example',
        };
    }

    #[\Override]
    public function getColor(): string | array | null
    {
        return match ($this) {
            self::ExampleRead => 'success',
            self::ExampleWrite => 'danger',
        };
    }

    #[\Override]
    public function getDescription(): ?string
    {
        return match ($this) {
            self::ExampleRead => 'Allows reading of all example data',
            self::ExampleWrite => 'Allows writing of example data',
        };
    }

    public function getHtmlLabel(): string
    {
        return view('partials.oauth.scope-label', ['scope' => $this])->render();
    }

    public static function getHtmlOptions(): array
    {
        return collect(self::cases())
            ->mapWithKeys(fn (ClientScope $scope) => [$scope->value => $scope->getHtmlLabel()])
            ->all();
    }

    public static function getDescriptions(): array
    {
        $all = collect(self::cases())
            ->mapWithKeys(fn (ClientScope $scope) => [$scope->value => $scope->getDescription()])
            ->all();

        return $all;
    }
}
