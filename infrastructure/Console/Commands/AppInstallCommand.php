<?php

namespace Infrastructure\Console\Commands;

use Database\Seeders\AdminSeed;
use Illuminate\Console\Command;
use Infrastructure\Eloquent\Models\User;

/**
 * @codeCoverageIgnore
 */
final class AppInstallCommand extends Command
{
    protected $signature = 'app:install';

    protected $description = 'Project initial setup command.';

    public function handle(): int
    {
        $this->call('config:clear');
        $this->call('cache:clear');
        $this->call('route:clear');
        $this->call('key:generate', ['--force' => true]);
//        $this->call('storage:link');
        $this->call('migrate:fresh', ['--force' => true, '--seed' => true]);
        $this->call('l5-swagger:generate');
//        $this->call('generate:path');

        return 0;
    }
}
