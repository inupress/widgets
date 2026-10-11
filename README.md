# inupress/widgets

Content blocks for the Inupress CMS: fill an area of the theme from the admin, without code.

This package is developed in the `inupress/framework` monorepo (`packages/widgets`). Report issues and send changes there.

## Install

```bash
composer require inupress/widgets
php artisan migrate
```

The plugin is found and its admin resource appears in the panel on its own. Remove it with `composer remove inupress/widgets`; the `widgets_widgets` table is kept.

## What you get

- **Admin:** a **Widgets** resource. A block has an area, an optional title, rich-text content, an order you drag into place and an active flag. Inactive blocks stay in the admin and are not printed.
- **Site:** the theme prints an area by name, and nothing at all when the plugin is missing:

```blade
@includeIf('inupress-widgets::area', ['name' => 'footer', 'class' => 'inupress-widgets'])
```

- **Areas:** the default theme has a slot for `footer`, `sidebar` and `home`. The area is a free string, so a child theme or a plugin may render its own.

The markup wears the theme's component classes; the styles live in the theme (`docs/decisions/0010-themes.md`). A child theme may override the view like any other.

## Hook

`widgets.areas` (filter, owned by this plugin) adds an area to the admin picker:

```php
$hooks->addFilter('widgets.areas', function (array $areas): array {
    $areas['product-sidebar'] = 'Product sidebar';

    return $areas;
});
```

## Notes

The block body is printed as trusted HTML, the same way a WordPress text widget does it. Only give editing access to people you trust until roles and sanitizing exist.

## Requirements

`inupress/core` 0.1, Filament 5, PHP 8.3 or newer.

## License

MIT
