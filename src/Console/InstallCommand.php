<?php

namespace Kristories\Dashkit\Console;

use Illuminate\Console\Command;
use Illuminate\Support\Str;

class InstallCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'dashkit:install';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Install all of the Dashkit resources';

    /**
     * Execute the console command.
     *
     * @return void
     */
    public function handle()
    {
        $this->comment('Intalling..');
        $this->callSilent('vendor:publish', ['--tag' => 'dashkit-view']);
        $this->callSilent('vendor:publish', ['--tag' => 'dashkit-config']);

        $this->callSilent('vendor:publish', [
            '--provider' => 'Spatie\Dashboard\DashboardServiceProvider',
        ]);
        $this->callSilent('vendor:publish', [
            '--tag' => 'livewire:config',
        ]);

        $this->info('Dashkit scaffolding installed successfully.');
    }
}
