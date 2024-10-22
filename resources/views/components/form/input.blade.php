@props([
    'type' => 'text',
    'label' => 'Label',
    'descriptionTrailing' => '',
])

<x-form.item>
    <x-form.label>
        {{ $label }}
    </x-form.label>

    <x-input
        type="{{ $type }}"
        x-form:control
        {{ $attributes }}
    />

    @if ($descriptionTrailing)
        <x-form.description>
            {{ $descriptionTrailing }}
        </x-form.description>
    @endif

    <x-form.message
        name="{{ $attributes->has('wire:model') ? $attributes->get('wire:model') : $attributes->get('name') }}"
    />
</x-form.item>
