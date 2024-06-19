@props([
    'name' => '',
])
<div
    x-form:item
    @error($name) error="true" @enderror
    {{ $attributes->twMerge('space-y-2') }}
>
    {{ $slot }}
</div>
