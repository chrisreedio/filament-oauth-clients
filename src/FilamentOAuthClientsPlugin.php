<?php

namespace ChrisReedIO\FilamentOAuthClients;

use Closure;
use Filament\Contracts\Plugin;
use Filament\Panel;
use Filament\Support\Concerns\EvaluatesClosures;

class FilamentOAuthClientsPlugin implements Plugin
{
    use EvaluatesClosures;

    protected bool | Closure $registerCluster = true;

    public function getId(): string
    {
        return 'filament-oauth-clients';
    }

    public function register(Panel $panel): void
    {
        $panel->discoverClusters(in: __DIR__ . '/Clusters', for: 'ChrisReedIO\FilamentOAuthClients\Clusters');
    }

    public function boot(Panel $panel): void
    {
        //
    }

    public static function make(): static
    {
        return app(static::class);
    }

    public static function get(): static
    {
        /** @var static $plugin */
        $plugin = filament(app(static::class)->getId());

        return $plugin;
    }

    public function registerCluster(bool | Closure $registerCluster = true): static
    {
        $this->registerCluster = $registerCluster;

        return $this;
    }

    public function isAuthorized(): bool
    {
        return $this->evaluate($this->registerCluster) === true;
    }
}
