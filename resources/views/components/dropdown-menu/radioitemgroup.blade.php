@props([
    'defaultValue' => '',
])

<li
    x-init="'{{ $defaultValue }}' ? init('{{ $defaultValue }}'): null"
    x-dropdown-menu:radiogroup
    role="none"
>
    <ul role="group">
        {{ $slot }}
    </ul>
</li>
