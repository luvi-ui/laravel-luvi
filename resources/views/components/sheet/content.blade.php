@props([
    'side' => 'right',
])

@php
    $one = match ($side) {
        'top' => '-translate-y-full',
        'right' => 'translate-x-full',
        'bottom' => 'translate-y-full',
        'left' => '-translate-x-full',
    };

    $two = match ($side) {
        'top' => '-translate-y-0',
        'right' => 'translate-x-0',
        'bottom' => 'translate-y-0',
        'left' => 'translate-x-0',
    };
@endphp

@inject('sheet', 'App\Services\SheetCvaService')

<div @keydown.escape.window="open = false">
    <template x-teleport="body">
        <x-sheet.overlay />
    </template>

    <template x-teleport="body">
        <div
            x-show="open"
            x-transition:enter="transition ease-out duration-500"
            x-transition:enter-start="{{ $one }}"
            x-transition:enter-end="{{ $two }}"
            x-transition:leave="transition ease-in duration-300"
            x-transition:leave-start="{{ $two }}"
            x-transition:leave-end="{{ $one }}"
            {{ $attributes->twMerge($sheet(['side' => $side])) }}
        >
            <x-sheet.close
                variant="icon"
                class="noway absolute right-4 top-4 rounded-sm opacity-70 ring-offset-background transition-opacity hover:opacity-100 focus:outline-none focus:ring-2 focus:ring-ring focus:ring-offset-2 disabled:pointer-events-none"
            >
                <x-lucide-x class="size-4" />
            </x-sheet.close>
            {{ $slot }}
        </div>

    </template>

</div>
