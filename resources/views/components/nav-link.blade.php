@props(['active'])

<a {{ $attributes->class(['studio-nav-link', 'is-active' => $active ?? false]) }}>
    {{ $slot }}
</a>
