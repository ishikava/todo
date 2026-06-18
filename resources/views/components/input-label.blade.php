@props(['value'])

<label {{ $attributes->merge(['style' => 'display: block; font-size: 0.875rem; font-weight: 500; color: #374151;']) }}>
    {{ $value ?? $slot }}
</label>
