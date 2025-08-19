<?php

namespace ChrisReedIO\FilamentOAuthClients\Clusters;

use Filament\Clusters\Cluster;
use Filament\Support\Enums\MaxWidth;

class OAuth extends Cluster
{
    protected static ?string $navigationIcon = 'heroicon-o-shield-check';

    protected static ?string $navigationLabel = 'OAuth';

    protected static ?string $clusterBreadcrumb = 'OAuth';

    protected static ?string $slug = 'oauth';

    public function getMaxContentWidth(): MaxWidth
    {
        return MaxWidth::Full;
    }
}
