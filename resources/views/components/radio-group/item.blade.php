<input
    type="radio"
    :name="name"
    x-model="__selected"
    {{ $attributes->twMerge('aspect-square h-4 w-4 rounded-full border border-primary text-primary shadow focus:outline-none focus-visible:ring-1 focus-visible:ring-ring disabled:cursor-not-allowed disabled:opacity-50') }}
/>
