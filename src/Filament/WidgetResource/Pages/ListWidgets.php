<?php

declare(strict_types=1);

namespace Inupress\Widgets\Filament\WidgetResource\Pages;

use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;
use Inupress\Widgets\Filament\WidgetResource;

final class ListWidgets extends ListRecords
{
    protected static string $resource = WidgetResource::class;

    protected function getHeaderActions(): array
    {
        return [CreateAction::make()];
    }
}
