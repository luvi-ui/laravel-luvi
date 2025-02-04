@props([
    'collapsible' => 'offcanvas',
])

<div class="h-screen flex" x-data x-sidebar data-options='{ "collapsible": "{{ $collapsible }}" }'>
    {{ $slot }}
</div>