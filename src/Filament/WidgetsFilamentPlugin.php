<?php

declare(strict_types=1);

namespace Inupress\Widgets\Filament;

use Filament\Contracts\Plugin;
use Filament\Panel;

final class WidgetsFilamentPlugin implements Plugin
{
    public function getId(): string
    {
        return 'inupress-widgets';
    }

    public function register(Panel $panel): void
    {
        $panel->resources([WidgetResource::class]);
    }

    public function boot(Panel $panel): void {}
}
