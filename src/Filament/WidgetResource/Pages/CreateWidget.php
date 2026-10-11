<?php

declare(strict_types=1);

namespace Inupress\Widgets\Filament\WidgetResource\Pages;

use Filament\Resources\Pages\CreateRecord;
use Inupress\Widgets\Filament\WidgetResource;

final class CreateWidget extends CreateRecord
{
    protected static string $resource = WidgetResource::class;
}
