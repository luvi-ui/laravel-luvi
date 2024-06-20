@props([
    'disabled' => false,
])
<li
    role="menuitemcheckbox"
    aria-disabled="{{ $disabled ? 'true' : 'false' }}"
    x-dropdown-menu:checkboxitem
    aria-label="{{ $slot }}"
    tabindex="-1"
    {{ $attributes->when($disabled, function ($attributes) {
            return $attributes->except(['x-model', 'wire:model']);
        })->twMerge([
            'hover:bg-accent hover:text-accent-foreground focus:bg-accent focus:text-accent-foreground',
            'relative flex w-full cursor-default select-none items-center',
            'rounded-sm py-1.5 text-sm outline-none transition-colors',
            'opacity-50 cursor-not-allowed' => $disabled,
            'pl-8',
        ]) }}
>

    <span
        class="absolute left-2 flex h-3.5 w-3.5 items-center justify-center"
        x-show="__isChecked"
    >
        <x-lucide-check class="w-4 h-4" />
    </span>
    {{ $slot }}
</li>
