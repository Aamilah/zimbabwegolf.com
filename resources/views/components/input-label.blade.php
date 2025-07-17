@props(['value'])

<label {{ $attributes->merge(['class' => 'text-sm mb-2 my-3']) }}>
    {{ $value ?? $slot }}
</label>
