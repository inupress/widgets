<?php

declare(strict_types=1);

namespace Inupress\Widgets\Filament\WidgetResource\Pages;

use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;
use Inupress\Widgets\Filament\WidgetResource;

final class EditWidget extends EditRecord
{
    protected static string $resource = WidgetResource::class;

    protected function getHeaderActions(): array
    {
        return [DeleteAction::make()];
    }
}
