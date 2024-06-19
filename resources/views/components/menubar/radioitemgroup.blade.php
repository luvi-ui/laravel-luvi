@props([
    'defaultValue' => '',
])

<li
    x-init="'{{ $defaultValue }}' ? init('{{ $defaultValue }}'): null"
    x-menubar:radiogroup
    role="none"
>
    <ul role="group">
        {{ $slot }}
    </ul>
</li>
