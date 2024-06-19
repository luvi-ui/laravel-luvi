@aware(['name'])
@props([
    'name' => '',
])

@error($name)
    <p
        x-form:message.assertive
        {{ $attributes->merge(['class' => 'text-[0.8rem] font-medium text-destructive']) }}
    >
        {{ $message }}
    </p>
@enderror
