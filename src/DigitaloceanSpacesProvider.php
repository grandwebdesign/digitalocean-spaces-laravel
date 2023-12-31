<?php

namespace Grandwebdesign\DigitaloceanSpacesLaravel;

use Illuminate\Support\ServiceProvider;

class DigitaloceanSpacesProvider extends ServiceProvider
{
    public function register()
    {
        $this->mergeConfigFrom(
            __DIR__ . '/config/digitaloceanfilesystem.php', 'filesystems.disks'
        );
    }

    public function boot()
    {
        $this->publishes([
            __DIR__ . '/config/digitaloceanspaces.php' => config_path('digitaloceanspaces.php'),
        ], 'config');
    }
}
