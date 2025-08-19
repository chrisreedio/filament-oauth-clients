<?php

namespace ChrisReedIO\FilamentOAuthClients\Clusters;

use BackedEnum;
use Filament\Clusters\Cluster;
use Filament\Support\Enums\Width;

class OAuth extends Cluster
{
    protected static BackedEnum | string | null $navigationIcon = 'heroicon-o-shield-check';

    protected static ?string $navigationLabel = 'OAuth';

    protected static ?string $clusterBreadcrumb = 'OAuth';

    protected static ?string $slug = 'oauth';

    public function getMaxContentWidth(): Width
    {
        return Width::Full;
    }
}
