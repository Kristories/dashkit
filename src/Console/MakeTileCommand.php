<?php

namespace Kristories\Dashkit\Console;

use Illuminate\Console\GeneratorCommand;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;

class MakeTileCommand extends GeneratorCommand
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'dashkit:make-tile {name} {--force} {--inline}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a new tile';

    /**
     * Execute the console command.
     *
     * @return bool|null
     *
     * @throws \Illuminate\Contracts\Filesystem\FileNotFoundException
     */
    public function handle()
    {
        parent::handle();

        $this->createView();
    }

    /**
     * Replace the namespace for the given stub.
     *
     * @param string $stub
     * @param string $name
     *
     * @return $this
     */
    protected function replaceNamespace(&$stub, $name)
    {
        parent::replaceNamespace($stub, $name);

        $stub = str_replace(
            '{{ viewname }}',
            str_replace('/', '.', 'tiles/' . $this->makeViewName()),
            $stub
        );

        return $this;
    }

    /**
     * Get the stub file for the generator.
     *
     * @return string
     */
    protected function getStub()
    {
        return __DIR__ . '/stubs/Tile.stub';
    }

    /**
     * Get the default namespace for the class.
     *
     * @param  string  $rootNamespace
     * @return string
     */
    protected function getDefaultNamespace($rootNamespace)
    {
        return config('livewire.class_namespace');
    }

    /**
     * Create a new view file for the tile.
     *
     * return void
     */
    protected function createView()
    {
        if ($this->files->exists($path = $this->getViewPath())) {
            $this->error('View already exists!');

            return;
        }

        $stub = __DIR__ . '/stubs/tile.blade.stub';

        $this->makeDirectory($path);
        $this->files->put($path, file_get_contents($stub));
        $this->info('View created successfully.');
    }

    /**
     * Get the destination view path.
     *
     * @return string
     */
    protected function getViewPath()
    {
        return base_path('resources/views') . '/tiles/' . $this->makeViewName() . '.blade.php';
    }

    /**
     * Get the destination view name without extensions.
     *
     * @return string
     */
    protected function makeViewName()
    {
        $name = str_replace($this->laravel->getNamespace(), '', $this->argument('name'));
        $name = str_replace('\\', '/', $name);
        $nameArray = explode('/', $name);

        array_walk($nameArray, function (&$part) {
            $part = Str::snake($part);
        });

        return implode('/', $nameArray);
    }
}
