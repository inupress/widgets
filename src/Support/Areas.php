<?php

declare(strict_types=1);

namespace Inupress\Widgets\Support;

use Inupress\Contracts\HookRegistry;
use Inupress\Widgets\Models\Widget;

/**
 * The areas a widget can go into. The default theme renders `footer`, `sidebar` and
 * `home` (Widget::AREAS); a child theme or a plugin adds its own with the plugin owned
 * filter, so the widget admin never blocks a new area:
 *
 * ```php
 * $hooks->addFilter('widgets.areas', function (array $areas): array {
 *     $areas['product-sidebar'] = 'Product sidebar';
 *     return $areas;
 * });
 * ```
 *
 * A malformed entry is skipped; an empty result falls back to the built-in list.
 */
final class Areas
{
    /** Filter name, owned by this plugin: docs/hooks.md asks for the plugin prefix. */
    public const FILTER = 'widgets.areas';

    /** @return array<string, string> */
    public static function all(): array
    {
        $raw = app(HookRegistry::class)->applyFilters(self::FILTER, Widget::AREAS);

        if (! is_array($raw)) {
            return Widget::AREAS;
        }

        $areas = [];

        foreach ($raw as $key => $label) {
            if (is_string($key) && $key !== '' && is_string($label) && $label !== '') {
                $areas[$key] = $label;
            }
        }

        return $areas === [] ? Widget::AREAS : $areas;
    }
}
