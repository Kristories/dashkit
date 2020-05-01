# Dashkit

[![Packagist](https://img.shields.io/packagist/v/kristories/dashkit.svg)](https://packagist.org/packages/kristories/dashkit)
[![Packagist](https://poser.pugx.org/kristories/dashkit/d/total.svg)](https://packagist.org/packages/kristories/dashkit)
[![Packagist](https://img.shields.io/packagist/l/kristories/dashkit.svg)](https://packagist.org/packages/kristories/dashkit)

[Spatie's laravel-dashboard](https://github.com/spatie/laravel-dashboard) toollkit

## Installation

Install via composer
```bash
composer require kristories/dashkit
```

After installing Dashkit, publish its assets using the `dashkit:install` Artisan command:

```bash
php artisan dashkit:install
```

Dashkit exposes a dashboard at `/dashkit`.

## Configuration

After publishing Dashkit's assets, its primary configuration file will be located at `config/dashkit.php`.

> Dashkit also publishes [laravel-dashboard](https://github.com/spatie/laravel-dashboard) and [Livewire](https://github.com/livewire/livewire) assets.

## Usage

#### Make a tile

```bash
php artisan dashkit:make-tile MyTile
```

This command generates :

**`app/Http/Livewire/MyTile.php`**

```php
namespace App\Http\Livewire;

use Livewire\Component;

class MyTile extends Component
{
    /** @var string */
    public $position;

    public function mount(string $position)
    {
        $this->position = $position;
    }

    public function render()
    {
        return view('tiles.my_tile');
    }
}

```

**`resources/views/tiles/my_tile.blade.php`**

```html
<x-dashboard-tile :position="$position">
    <h1>Hi, I'm a tile!</h1>
</x-dashboard-tile>
```

#### Adding tiles

> Dashkit has a main view that can be changed via `dashkit.php` configuration file.

Inside the `x-dashboard` tag, you can add your tile, or use any of the [available tiles](https://docs.spatie.be/laravel-dashboard/v1/adding-tiles/overview).

```html
<x-dashboard>
    <livewire:my-tile position="a1"/>
</x-dashboard>
```

## Security

If you discover any security related issues, please email w.kristories@gmail.com instead of using the issue tracker.

## Credits

- [Freek Van der Herten](https://github.com/freekmurze)
- [Wahyu Kristianto](https://github.com/kristories/dashkit)
- [All contributors](https://github.com/kristories/dashkit/graphs/contributors)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
