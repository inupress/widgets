<?php

declare(strict_types=1);

namespace Inupress\Widgets\Filament;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\ToggleColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;
use Inupress\Widgets\Filament\WidgetResource\Pages\CreateWidget;
use Inupress\Widgets\Filament\WidgetResource\Pages\EditWidget;
use Inupress\Widgets\Filament\WidgetResource\Pages\ListWidgets;
use Inupress\Widgets\Models\Widget;
use Inupress\Widgets\Support\Areas;

final class WidgetResource extends Resource
{
    protected static ?string $model = Widget::class;

    protected static string|\BackedEnum|null $navigationIcon = 'heroicon-o-squares-2x2';

    protected static ?string $recordTitleAttribute = 'title';

    public static function form(Schema $schema): Schema
    {
        return $schema->components([
            Select::make('area')
                ->options(fn (): array => Areas::all())
                ->required()
                ->default('footer')
                ->helperText('The areas the theme renders: the default theme has footer, sidebar and home.'),
            TextInput::make('title')
                ->maxLength(255)
                ->helperText('Optional. Shown as the heading of the block.'),
            RichEditor::make('body')
                ->helperText('The content of the block. HTML is allowed, as in the WordPress text widget.'),
            Toggle::make('is_active')
                ->label('Active')
                ->default(true)
                ->helperText('An inactive block stays in the admin and is not printed.'),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('title')->placeholder('—')->searchable(),
                TextColumn::make('area')->badge()->sortable(),
                TextColumn::make('position')->label('Order')->sortable(),
                ToggleColumn::make('is_active')->label('Active'),
            ])
            ->defaultSort('position')
            ->reorderable('position')
            ->filters([
                SelectFilter::make('area')->options(fn (): array => Areas::all()),
            ])
            ->recordActions([EditAction::make()])
            ->toolbarActions([BulkActionGroup::make([DeleteBulkAction::make()])]);
    }

    public static function getPages(): array
    {
        return [
            'index' => ListWidgets::route('/'),
            'create' => CreateWidget::route('/create'),
            'edit' => EditWidget::route('/{record}/edit'),
        ];
    }
}
