<?php

declare(strict_types=1);

namespace Inupress\Widgets;

use Inupress\Contracts\ProvidesFilament;
use Inupress\Widgets\Filament\WidgetsFilamentPlugin;
use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;

final class WidgetsServiceProvider extends PackageServiceProvider implements ProvidesFilament
{
    public static string $name = 'inupress-widgets';

    public function filamentPlugin(): WidgetsFilamentPlugin
    {
        return new WidgetsFilamentPlugin;
    }

    public function configurePackage(Package $package): void
    {
        $package
            ->name(self::$name)
            ->hasViews()
            ->discoversMigrations()
            ->runsMigrations();
    }
}
