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
}
