@props([
    'value' => '',
    'checked' => false,
])

<div>
    <x-radio-group.item
        :id=$value
        :$value
        :$checked
        class="peer sr-only"
    />

    <x-label
        :htmlFor=$value
        {{ $attributes->twMerge('inline-flex w-full items-center justify-center whitespace-nowrap rounded-md px-3 py-1 text-sm font-medium ring-offset-background transition-all cursor-pointer peer-focus-visible:outline-none peer-focus-visible:ring-2 peer-focus-visible:ring-ring peer-focus-visible:ring-offset-2 disabled:pointer-events-none disabled:opacity-50 peer-checked:bg-background peer-checked:text-foreground peer-checked:shadow') }}
    >
        {{ $slot }}
    </x-label>
</div>
