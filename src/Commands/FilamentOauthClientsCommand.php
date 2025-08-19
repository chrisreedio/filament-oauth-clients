<?php

namespace ChrisReedIO\FilamentOAuthClients\Commands;

use Illuminate\Console\Command;

class FilamentOAuthClientsCommand extends Command
{
    public $signature = 'filament-oauth-clients';

    public $description = 'My command';

    public function handle(): int
    {
        $this->comment('All done');

        return self::SUCCESS;
    }
}
