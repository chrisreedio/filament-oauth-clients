<?php

namespace ChrisReedIO\FilamentOAuthClients\Models\Traits;

trait HasPageClipboard
{
    public function copyTokenClipboard(string $token): void
    {
        $this->js(
            'window.navigator.clipboard.writeText("' . $token . '");
            $tooltip("' . __('Copied to clipboard') . '", { timeout: 1500 });'
        );
    }
}
