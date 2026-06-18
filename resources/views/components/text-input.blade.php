@props(['value'])

<input {{ $attributes->merge(['style' => 'border-color: #d1d5db; border-radius: 0.5rem; box-shadow: 0 1px 2px 0 rgba(0, 0, 0, 0.05);']) }} value="{{ old($name, $value) }}">
