@props([
    'side' => 'right',
])

@inject('sheet', 'App\Services\DialogCvaService')

<dialog
    wire:ignore.self
    x-on:cancel="__sheetOpen = false"
    x-trap.noscroll="__sheetOpen"
    x-effect="__sheetOpen ? $el.showModal() : $el.close()"
    {{ $attributes->twMerge($sheet(['side' => $side, 'variant' => 'sheet'])) }}
>
    <x-sheet.close
        variant="icon"
        class="absolute right-4 top-4 rounded-sm opacity-70 ring-offset-background transition-opacity hover:opacity-100 focus:outline-none focus:ring-2 focus:ring-ring focus:ring-offset-2 disabled:pointer-events-none"
    >
        <x-lucide-x class="size-4" />
    </x-sheet.close>
    {{ $slot }}
</dialog>
