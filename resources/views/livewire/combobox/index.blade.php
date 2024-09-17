<div>
    <x-popover wire:model="show">
        <x-popover.trigger>
            <button
                class="inline-flex items-center whitespace-nowrap rounded-md text-sm font-medium transition-colors focus-visible:outline-none focus-visible:ring-1 focus-visible:ring-ring disabled:pointer-events-none disabled:opacity-50 border border-input bg-background shadow-sm hover:bg-accent hover:text-accent-foreground h-9 px-4 py-2 w-[200px] justify-between"
            >
                @if ($selected)
                    {{ $selected->{$display} }}
                @else
                    {{ __($placeholder) }}
                @endif
                <x-lucide-chevrons-up-down class="ml-2 size-4 shrink-0 opacity-50" />
            </button>
        </x-popover.trigger>
        <x-popover.content class="w-[200px] p-0">
            <div class="flex items-center border-b px-3">
                <x-lucide-search class="size-4 mr-2 shrink-0 opacity-50" />
                <x-input
                    wire:model.live="search"
                    placeholder="{{ __($placeholder) }}"
                    class="py-3 px-0 outline-none border-none focus-visible:ring-0"
                />
            </div>
            @foreach ($results as $result)
                <div
                    wire:click="select('{{ $result->id }}')"
                    class="hover:bg-accent relative flex cursor-default select-none items-center rounded-sm px-2 py-1.5 text-sm outline-none data-[disabled=true]:pointer-events-none data-[selected=true]:bg-accent data-[selected=true]:text-accent-foreground data-[disabled=true]:opacity-50",
                >
                    {{ $result->{$display} }}

                    @if ($value === $result->id)
                        <x-lucide-check class="size-4 ml-auto h-4 w-4 opacity-100" />
                    @endif
                </div>
            @endforeach
            @if ($search && $results->isEmpty())
                <p class="py-6 text-center text-sm">{{ __('No results found') }}</p>
            @endif
        </x-popover.content>
    </x-popover>
</div>
