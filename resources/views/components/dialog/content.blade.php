<dialog
    x-ref="__dialog"
    {{ $attributes->twMerge('w-full max-w-lg border bg-background p-6 shadow-lg  sm:rounded-lg transition-[translate,opacity,scale,overlay,display] [transition-behavior:allow-discrete] open:animate-in open:fade-in-0 open:zoom-in-95 animate-out duration-200 fade-out-0 zoom-out-95 backdrop:bg-black/80 backdrop:duration-300 backdrop:opacity-0 backdrop:transition-[opacity,display,overlay] backdrop:[transition-behavior:allow-discrete] open:backdrop:opacity-100 [@starting-style]:open:backdrop:opacity-0') }}
>
    {{ $slot }}

    <button
        class="absolute right-4 top-4 rounded-sm opacity-70 ring-offset-background transition-opacity hover:opacity-100 focus:outline-none focus:ring-2 focus:ring-ring focus:ring-offset-2 disabled:pointer-events-none data-[state=open]:bg-accent data-[state=open]:text-muted-foreground"
        variant="ghost"
        size="icon"
        @click="$refs.__dialog.close()"
    >
        <x-lucide-x class="size-4" />
        <span class="sr-only">Close</span>
    </button>
</dialog>
