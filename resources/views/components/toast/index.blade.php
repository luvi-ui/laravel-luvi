@props(['position' => 'bottom-right'])

@php
$positionClasses = [
'bottom-left' => 'bottom-5 left-5',
'bottom-right' => 'bottom-5 right-5',
'top-left' => 'top-5 left-5',
'top-right' => 'top-5 right-5',
];

$isTopPosition = in_array($position, ['top-left', 'top-right']);
$flexDirection = $isTopPosition ? 'flex-col' : 'flex-col-reverse';
$translateClass = $isTopPosition ? '-translate-y-4' : 'translate-y-4';
@endphp

<div x-data x-init="$store.toasts.init()"
    class="fixed {{ $positionClasses[$position] ?? $positionClasses['bottom-right'] }} z-50 flex {{ $flexDirection }} gap-3 w-80 max-w-sm pointer-events-none"
    role="status" aria-live="polite">

    @if($isTopPosition)
    <template x-for="toast in $store.toasts.items.slice().reverse()" :key="toast.id">
        @else
        <template x-for="toast in $store.toasts.items" :key="toast.id">
            @endif
            <div x-show="toast.show"
                class="transform transition-all duration-300 ease-in-out flex items-center justify-between px-4 py-3 rounded-lg shadow-lg pointer-events-auto overflow-hidden bg-[hsl(var(--card))] text-[hsl(var(--card-foreground))] outline outline-[hsl(var(--border))]"
                role="status" x-transition:enter="transition ease-out duration-300 transform"
                x-transition:enter-start="opacity-0 {{ $translateClass }}"
                x-transition:enter-end="opacity-100 translate-y-0"
                x-transition:leave="transition ease-in duration-300 transform"
                x-transition:leave-start="opacity-100 translate-y-0"
                x-transition:leave-end="opacity-0 {{ $translateClass }}"
                @mouseenter="$store.toasts.pauseToast(toast.id)" @mouseleave="$store.toasts.resumeToast(toast.id)">

                <div class="flex flex-col min-h-[60px]"
                    :class="toast.['actionLabel'] ? 'justify-between' : 'justify-center'">
                    <x-typography.p x-text="toast.message" class="break-words max-w-xs text-center">
                    </x-typography.p>

                    <button x-show="toast.actionLabel" x-text="toast.actionLabel"
                        @click="$store.toasts.handleAction(toast)"
                        class="mt-2 text-sm font-medium text-left text-[hsl(var(--card-foreground))] hover:cursor-pointer">
                    </button>
                </div>

                <button @click="$store.toasts.removeToastWithAnimation(toast.id)"
                    class="ml-3 transition-colors duration-200 flex-shrink-0 text-[hsl(var(--card-foreground))] hover:cursor-pointer"
                    aria-label="Close notification">
                    <x-lucide-x class="w-4 h-4" />
                </button>
            </div>
        </template>
</div>