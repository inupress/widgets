<?php

declare(strict_types=1);

namespace Inupress\Widgets\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Schema;

/**
 * A content block the site owner edits in the admin and the theme prints in an area:
 * `@includeIf('inupress-widgets::area', ['name' => 'footer'])`.
 *
 * @property int $id
 * @property string $area
 * @property string|null $title
 * @property string|null $body
 * @property int $position
 * @property bool $is_active
 */
#[Fillable(['area', 'title', 'body', 'position', 'is_active'])]
class Widget extends Model
{
    protected $table = 'widgets_widgets';

    /**
     * Areas the default theme has a slot for. Only a suggestion: the area is a free
     * string, so a plugin or a child theme may render its own.
     */
    public const AREAS = ['footer' => 'Footer', 'sidebar' => 'Sidebar', 'home' => 'Home'];

    /** @return array<string, string> */
    protected function casts(): array
    {
        return [
            'is_active' => 'boolean',
            'position' => 'integer',
        ];
    }

    /** @param Builder<Widget> $query */
    public function scopeForArea(Builder $query, string $area): void
    {
        $query->where('area', $area);
    }

    /** @param Builder<Widget> $query */
    public function scopeActive(Builder $query): void
    {
        $query->where('is_active', true);
    }

    /**
     * The blocks of one area, ready to render.
     *
     * Empty when the table is not migrated yet: `composer require` without `php artisan migrate`
     * leaves the site working with an empty area instead of a 500.
     *
     * @return Collection<int, Widget>
     */
    public static function inArea(string $area): Collection
    {
        if (! Schema::hasTable((new self)->getTable())) {
            return new Collection;
        }

        return static::query()
            ->forArea($area)
            ->active()
            ->orderBy('position')
            ->get();
    }
}
