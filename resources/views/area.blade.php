{{--
    The public markup of one widget area. A theme includes it softly, so a site that does
    not install inupress/widgets renders nothing and never errors:

        @includeIf('inupress-widgets::area', ['name' => 'footer', 'class' => 'inupress-widgets'])

    Styling lives in the theme; this file only wears the theme's component classes
    (docs/decisions/0010-themes.md). The body is admin content and is printed as HTML,
    the same way a WordPress text widget does it.
--}}
@php
    $name = $name ?? 'footer';
    $class = $class ?? 'inupress-widgets';

    $blocks = \Inupress\Widgets\Models\Widget::inArea($name);
@endphp

@if ($blocks->isNotEmpty())
    <div class="{{ $class }}">
        @foreach ($blocks as $block)
            <section class="inupress-widget">
                @if (filled($block->title))
                    <h2 class="inupress-widget-title">{{ $block->title }}</h2>
                @endif

                @if (filled($block->body))
                    <div class="inupress-prose">{!! $block->body !!}</div>
                @endif
            </section>
        @endforeach
    </div>
@endif
